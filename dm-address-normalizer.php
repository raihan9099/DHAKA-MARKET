<?php
/**
 * Plugin Name: DM Address Normalizer
 * Description: Normalize Bangladeshi addresses into district, upazila, thana, union fields.
 * Version: 1.0.0
 * Author: Your Team
 */

if (!defined('ABSPATH')) exit;

final class DM_Address_Normalizer {
  public function init() {
    add_action('add_meta_boxes', [$this, 'add_order_metabox']);
    add_action('save_post', [$this, 'save_normalized_meta'], 10, 2);
  }

  public function add_order_metabox() {
    add_meta_box('dm_normalizer', __('Address Normalizer', 'dhaka-market'), [$this, 'render_metabox'], 'shop_order', 'side');
  }

  public function render_metabox($post) {
    echo '<textarea name="dm_raw_address" style="width:100%;height:90px"></textarea>';
    echo '<p><button class="button">'.__('Normalize', 'dhaka-market').'</button></p>';
  }

  public function save_normalized_meta($post_id, $post) {
    if ($post->post_type !== 'shop_order') return;
    $raw = isset($_POST['dm_raw_address']) ? sanitize_text_field($_POST['dm_raw_address']) : '';
    $normalized = $this->normalize($raw);
    foreach (['district','upazila','thana','union'] as $key) {
      update_post_meta($post_id, "_dm_$key", $normalized[$key] ?? '');
    }
  }

  private function normalize($raw) {
    $clean = preg_replace('/[^অ-হA-Za-z0-9 ,.-]/u', '', $raw);
    $clean = mb_strtolower($clean, 'UTF-8');
    return [
      'district' => $this->match_district($clean),
      'upazila'  => $this->match_upazila($clean),
      'thana'    => $this->match_thana($clean),
      'union'    => $this->match_union($clean),
    ];
  }

  private function match_district($t){ return ''; }
  private function match_upazila($t){ return ''; }
  private function match_thana($t){ return ''; }
  private function match_union($t){ return ''; }
}

(new DM_Address_Normalizer())->init();
