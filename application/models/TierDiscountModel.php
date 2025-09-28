<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TierDiscountModel extends CI_Model
{
    private $table = 'tier_discounts';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getDiscountsWithCustomerCount()
    {
        $this->db->select('td.*, COALESCE(COUNT(c.id_customer), 0) as customer_count');
        $this->db->from($this->table . ' td');
        $this->db->join('customers c', 'td.tier_level = c.tier_level', 'left');
        $this->db->group_by('td.tier_level');
        $this->db->order_by('FIELD(td.tier_level, "bronze", "silver", "gold", "platinum")');
        return $this->db->get()->result();
    }

    public function getByTier($tier_level)
    {
        return $this->db->get_where($this->table, ['tier_level' => $tier_level])->row();
    }

    public function updateDiscount($tier_level, $data)
    {
        return $this->db->where('tier_level', $tier_level)->update($this->table, $data);
    }

    public function getActiveDiscounts()
    {
        return $this->db->get_where($this->table, ['is_active' => 1])->result();
    }

    public function getDiscountAmount($tier_level)
    {
        $discount = $this->db->select('discount_amount')
                            ->get_where($this->table, [
                                'tier_level' => $tier_level,
                                'is_active' => 1
                            ])->row();
        
        return $discount ? $discount->discount_amount : 0;
    }
}