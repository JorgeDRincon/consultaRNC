<?php

namespace Tests\Unit;

use App\Models\Rnc;
use PHPUnit\Framework\TestCase;

class RncModelTest extends TestCase
{
    // ========================================================================
    // TESTS FOR: validateStatusValue() - Status Validation Method
    // ========================================================================

    /**
     * @group validateStatusValue
     * @group validation
     * @group happy-path
     * Test that Rnc::validateStatusValue() returns true for valid statuses
     */
    public function test_validate_status_value_returns_true_for_valid_statuses()
    {
        foreach (Rnc::ALLOWED_STATUSES as $status) {
            $result = Rnc::validateStatusValue($status);

            $this->assertTrue($result['valid'], "Status '{$status}' should be valid");
            $this->assertArrayNotHasKey('error', $result);
        }
    }

    /**
     * @group validateStatusValue
     * @group validation
     * @group case-sensitivity
     * Test that validateStatusValue is case-insensitive for valid statuses
     */
    public function test_validate_status_value_is_case_insensitive()
    {
        $statusVariations = [
            'activo',
            'ACTIVO',
            'AcTiVo',
            'anulado',
            'RECHAZADO',
            'suspendido',
        ];

        foreach ($statusVariations as $status) {
            $result = Rnc::validateStatusValue($status);

            $this->assertTrue($result['valid'], "Status '{$status}' should be valid (case insensitive)");
        }
    }

    /**
     * @group validateStatusValue
     * @group validation
     * @group error-handling
     * Test that validateStatusValue returns false for invalid statuses
     */
    public function test_validate_status_value_returns_false_for_invalid_statuses()
    {
        $invalidStatuses = [
            'InvalidStatus',
            'Pendiente',
            'En Proceso',
            'Cancelado',
            '123',
            'activo123',
        ];

        foreach ($invalidStatuses as $status) {
            $result = Rnc::validateStatusValue($status);

            $this->assertFalse($result['valid'], "Status '{$status}' should be invalid");
            $this->assertArrayHasKey('error', $result);
            $this->assertArrayHasKey('message', $result['error']);
            $this->assertArrayHasKey('allowed_statuses', $result['error']);
            $this->assertStringContainsString($status, $result['error']['message']);
        }
    }

    /**
     * @group validateStatusValue
     * @group validation
     * @group edge-cases
     * Test that validateStatusValue accepts null and empty string as valid
     */
    public function test_validate_status_value_accepts_null_and_empty_string()
    {
        // Null should be valid (method returns true for falsy values)
        $result = Rnc::validateStatusValue(null);
        $this->assertTrue($result['valid']);

        // Empty string should also be valid (current model behavior)
        $result = Rnc::validateStatusValue('');
        $this->assertTrue($result['valid']);
        $this->assertArrayNotHasKey('error', $result);
    }

    /**
     * @group validateStatusValue
     * @group validation
     * @group error-structure
     * Test that validateStatusValue returns allowed statuses in error
     */
    public function test_validate_status_value_returns_allowed_statuses_in_error()
    {
        $result = Rnc::validateStatusValue('InvalidStatus');

        $this->assertFalse($result['valid']);
        $this->assertArrayHasKey('allowed_statuses', $result['error']);

        $allowedStatuses = $result['error']['allowed_statuses'];
        $this->assertEquals(Rnc::ALLOWED_STATUSES, $allowedStatuses);
    }

    /**
     * @group validateStatusValue
     * @group validation
     * @group edge-cases
     * Test edge cases for validateStatusValue
     */
    public function test_validate_status_value_edge_cases()
    {
        // Test with surrounding whitespace
        $result = Rnc::validateStatusValue('  Activo  ');
        $this->assertFalse($result['valid'], 'Status with spaces should be invalid');

        // Test with numbers
        $result = Rnc::validateStatusValue('123');
        $this->assertFalse($result['valid'], 'Numeric status should be invalid');

        // Test with special characters
        $result = Rnc::validateStatusValue('Activo@');
        $this->assertFalse($result['valid'], 'Status with special characters should be invalid');

        // Test with valid status but mixed case
        $result = Rnc::validateStatusValue('aCTiVo');
        $this->assertTrue($result['valid'], 'Valid status with mixed case should be valid');
    }

    /**
     * @group validateStatusValue
     * @group validation
     * @group edge-cases
     * Test that validateStatusValue with string '0' returns valid (falsy behavior)
     */
    public function test_validate_status_value_handles_falsy_string_values()
    {
        // String '0' is falsy in PHP, should return valid
        $result = Rnc::validateStatusValue('0');
        $this->assertTrue($result['valid']);
        $this->assertArrayNotHasKey('error', $result);
    }

    // ========================================================================
    // TESTS FOR: getAllowedSearchParams() - Parameters Configuration
    // ========================================================================

    /**
     * @group getAllowedSearchParams
     * @group search-configuration
     * @group parameters
     * Test that getAllowedSearchParams returns correct parameters
     */
    public function test_get_allowed_search_params_returns_correct_parameters()
    {
        $allowedParams = Rnc::getAllowedSearchParams();

        $expectedParams = [
            'rnc',
            'business_name',
            'economic_activity',
            'status',
            'payment_regime',
            'start_date',
            'page',
        ];

        $this->assertEquals($expectedParams, $allowedParams);
        $this->assertCount(7, $allowedParams);
    }

    /**
     * @group model-properties
     * @group hidden
     * @group security
     * Test that the model has correct hidden properties
     */
    public function test_model_has_correct_hidden_properties()
    {
        $rnc = new Rnc;
        $hidden = $rnc->getHidden();

        $expectedHidden = [
            'id',
            'created_at',
            'updated_at',
        ];

        $this->assertEquals($expectedHidden, $hidden);
    }
}
