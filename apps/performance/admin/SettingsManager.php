<?php
// admin/SettingsManager.php
class SettingsManager
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    // Get all settings
    public function getAllSettings()
    {
        $settings = [];
        $sql = "SELECT * FROM evaluation_settings ORDER BY category, setting_name";
        $result = $this->conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $settings[$row['setting_name']] = $this->parseSettingValue($row);
            }
        }

        return $settings;
    }

    // Get setting by name
    public function getSetting($name)
    {
        $sql = "SELECT * FROM evaluation_settings WHERE setting_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->parseSettingValue($row);
        }

        return null;
    }

    // Update setting
    public function updateSetting($name, $value)
    {
        $sql = "UPDATE evaluation_settings SET setting_value = ?, updated_at = CURRENT_TIMESTAMP WHERE setting_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $value, $name);

        return $stmt->execute();
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
        $active = $this->getSetting('evaluation_active');

        if (!$active || $active['value'] != '1') {
            return false;
        }

        // Check schedule if set
        $startDate = $this->getSetting('evaluation_start_date');
        $endDate = $this->getSetting('evaluation_end_date');

        $now = time();

        if ($startDate && $startDate['value'] && strtotime($startDate['value']) > $now) {
            return false;
        }

        if ($endDate && $endDate['value'] && strtotime($endDate['value']) < $now) {
            return false;
        }

        return true;
    }

    // Get redirect URL
    public function getRedirectUrl()
    {
        $url = $this->getSetting('redirect_url');
        return $url ? $url['value'] : 'https://app.merqconsultancy.org/apps/performance/inactive.php';
    }

    // Get SMTP settings
    public function getSmtpSettings()
    {
        return [
            'host' => $this->getSetting('smtp_host')['value'] ?? '',
            'port' => $this->getSetting('smtp_port')['value'] ?? '587',
            'username' => $this->getSetting('smtp_username')['value'] ?? '',
            'password' => $this->getSetting('smtp_password')['value'] ?? '',
            'encryption' => $this->getSetting('smtp_encryption')['value'] ?? 'tls',
            'from_email' => $this->getSetting('from_email')['value'] ?? '',
            'from_name' => $this->getSetting('from_name')['value'] ?? ''
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
}
