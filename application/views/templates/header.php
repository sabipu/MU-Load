<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $current = strtolower($this->uri->segment(1));
?>
<!DOCTYPE html>
<html>
<head>
  <title>Teaching Load Allocation - Murdoch University</title>
  <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>assets/css/dashboard.min.css" media="screen" />
  <style>
    .hide{
      display: none;
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <header class="dash__header">
      <div class="dash__logo">
        <a href="./dashboard">
          <img src="<?= base_url() ?>assets/images/logo.png" alt="MU Load">
        </a>
      </div>
      <!-- <h1>Dashboard</h1> -->
      <div class="header__right">
        <div class="user__wrap">
          <div class="user__profile">
            <?= file_get_contents(base_url() . 'assets/svg/user.svg') ?>
          </div>
          <div class="user__text">Admin</div>
        </div>
        <a href="<?= base_url() ?>logout" class="logout"><?= file_get_contents(base_url() . 'assets/svg/logout.svg') ?> Logout</a>
      </div>
    </header>
    <aside class="sidebar">
      <ul class="aside__nav">
        <li class="<?php if($current == "" || $current == "dashboard"){echo "active";}?>">
          <a href="<?php echo base_url('/dashboard'); ?>">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/dashboard.svg') ?>
            </span>
            <span class="nav__text">Dashboard</span>
          </a>
        </li>
        <li class="<?php if($current=="allocation"){echo "active";}?>">
          <a href="<?php echo base_url('/allocation'); ?>">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/allocation.svg') ?>
            </span>
            <span class="nav__text">Allocation</span>
          </a>
        </li>
        <li  class="<?php if($current=="manage-staff" || $this->uri->segment(1)=="register"){echo "active";}?>">
          <a href="<?php echo base_url('/manage-staff'); ?>">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/staff.svg') ?>
            </span>
            <span class="nav__text">Manage staff</span>
          </a>
        </li>
        <li  class="<?php if($current=="unit"){echo "active";}?>">
          <a href="<?php echo base_url('/unit'); ?>">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/units.svg') ?>
            </span>
            <span class="nav__text">Units</span>
          </a>
        </li>
        <li  class="<?php if($current=="activities"){echo "active";}?>">
          <a href="<?php echo base_url('/activities'); ?>">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/activity.svg') ?>
            </span>
            <span class="nav__text">Activities</span>
          </a>
        </li>
        <li  class="<?php if($current=="metrics"){echo "active";}?>">
          <a href="<?php echo base_url('/metrics'); ?>">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/formula.svg') ?>
            </span>
            <span class="nav__text">Metrics</span>
          </a>
        </li>
        <li  class="<?php if($this->uri->segment(1)=="reporting"){echo "active";}?>">
          <a href="<?php echo base_url('/reporting'); ?>/">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/report.svg') ?>
            </span>
            <span class="nav__text">Reports</span>
          </a>
        </li>
        <li  class="setting-menu <?php if($current=="settings"){echo "active";}?>">
          <a href="<?php echo base_url('/settings'); ?>">
            <span class="nav__icon">
              <?= file_get_contents(base_url() . 'assets/svg/setting.svg') ?>
            </span>
            <span class="nav__text">Settings</span>
          </a>
        </li>
      </ul>
    </aside>
    <div class="dash__container">
