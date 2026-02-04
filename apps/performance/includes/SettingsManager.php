<?php
// SettingsManager.php - Manages system settings
class SettingsManager
{
    private $conn;
    private $settings = [];

    public function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->loadSettings();
    }

    // Load all settings from database
    private function loadSettings()
    {
        $sql = "SELECT * FROM evaluation_settings ORDER BY category, setting_name";
        $result = $this->conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $this->settings[$row['setting_name']] = $this->parseSettingValue($row);
            }
        }
    }

    // Get all settings
    public function getAllSettings()
    {
        return $this->settings;
    }

    // Get setting by name
    public function getSetting($name)
    {
        return $this->settings[$name] ?? null;
    }

    // Get setting value
    public function getSettingValue($name)
    {
        return $this->settings[$name]['value'] ?? null;
    }

    // Update setting
    public function updateSetting($name, $value)
    {
        $sql = "UPDATE evaluation_settings SET setting_value = ?, updated_at = CURRENT_TIMESTAMP WHERE setting_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $value, $name);
        
        $result = $stmt->execute();
        $stmt->close();
        
        if ($result) {
            // Update local cache
            if (isset($this->settings[$name])) {
                $this->settings[$name]['value'] = $value;
            }
        }
        
        return $result;
    }

    // Update multiple settings
    public function updateSettings($settings)
    {
        $this->conn->begin_transaction();

        try {
            foreach ($settings as $name => $value) {
                if (!$this->updateSetting($name, $value)) {
                    throw new Exception("Failed to update setting: $name");
                }
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Settings update failed: " . $e->getMessage());
            return false;
        }
    }

    // Check if evaluation is active
    public function isEvaluationActive()
    {
        $active = $this->getSettingValue('evaluation_active');

        if (!$active || $active != '1') {
            return false;
        }

        // Check schedule if set
        $startDate = $this->getSettingValue('evaluation_start_date');
        $endDate = $this->getSettingValue('evaluation_end_date');

        $now = time();

        if ($startDate && strtotime($startDate) > $now) {
            return false;
        }

        if ($endDate && strtotime($endDate) < $now) {
            return false;
        }

        return true;
    }

    // Get redirect URL
    public function getRedirectUrl()
    {
        $url = $this->getSettingValue('redirect_url');
        return $url ?: 'https://app.merqconsultancy.org/apps/performance/inactive.php';
    }

    // Get SMTP settings
    public function getSmtpSettings()
    {
        return [
            'host' => $this->getSettingValue('smtp_host') ?? '',
            'port' => $this->getSettingValue('smtp_port') ?? '587',
            'username' => $this->getSettingValue('smtp_username') ?? '',
            'password' => $this->getSettingValue('smtp_password') ?? '',
            'encryption' => $this->getSettingValue('smtp_encryption') ?? 'tls',
            'from_email' => $this->getSettingValue('from_email') ?? '',
            'from_name' => $this->getSettingValue('from_name') ?? ''
        ];
    }

    // Get email notification settings
    public function getEmailSettings()
    {
        return [
            'notification_subject' => $this->getSettingValue('notification_subject') ?? 'Performance Evaluation Notification',
            'notification_template' => $this->getSettingValue('notification_template') ?? '',
            'auto_reminder_days' => $this->getSettingValue('auto_reminder_days') ?? 7
        ];
    }

    // Parse setting value based on type
    private function parseSettingValue($row)
    {
        $value = $row['setting_value'];

        switch ($row['setting_type']) {
            case 'boolean':
                $value = (bool)$value;
                break;
            case 'number':
                $value = is_numeric($value) ? $value + 0 : 0;
                break;
            case 'json':
                $value = json_decode($value, true) ?: [];
                break;
        }

        return [
            'value' => $value,
            'type' => $row['setting_type'],
            'description' => $row['description'],
            'category' => $row['category'],
            'required' => (bool)$row['is_required']
        ];
    }

    // Close connection
    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>