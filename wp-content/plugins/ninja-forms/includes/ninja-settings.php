<?php

function nf_get_settings(){
  $instance = Ninja_Forms();
  $settings = ! empty ( $instance ) ? Ninja_Forms()->plugin_settings : array();
  return $settings;
} // nf_get_settings