<?php use_helper('I18N', 'Date') ?>
<?php include_partial('nc_tracker_entry/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Details for tracking entry #%id%', array('%id%' => $ncTrackerEntry->getId())) ?></h1>

  <div id="sf_admin_content">
    <fieldset>
      <div class="sf_admin_form_row">
        <label for=""><?php echo __('User') ?></label>
        <div class="content">
          <div>
            <?php echo $ncTrackerEntry->getUserId() ?>
          </div>
        </div>
      </div>
      <div class="sf_admin_form_row">
        <label for=""><?php echo __('IP address') ?></label>
        <div class="content">
          <div>
            <?php echo $ncTrackerEntry->getIpAddress() ?>
          </div>
        </div>
      </div>
      <div class="sf_admin_form_row">
        <label for=""><?php echo __('Module') ?></label>
        <div class="content">
          <div>
            <?php include_partial('nc_tracker_entry/module_name', array('ncTrackerEntry' => $ncTrackerEntry)) ?>
          </div>
        </div>
      </div>
      <div class="sf_admin_form_row">
        <label for=""><?php echo __('Action') ?></label>
        <div class="content">
          <div>
            <?php include_partial('nc_tracker_entry/action_name', array('ncTrackerEntry' => $ncTrackerEntry)) ?>
          </div>
        </div>
      </div>
      <div class="sf_admin_form_row">
        <label for=""><?php echo __('Referrer') ?></label>
        <div class="content">
          <div>
            <?php echo $ncTrackerEntry->getReferrer() ? $ncTrackerEntry->getReferrer() : __('N/A') ?>
          </div>
        </div>
      </div>
      <div class="sf_admin_form_row">
        <label for=""><?php echo __('Accessed at') ?></label>
        <div class="content">
          <div>
            <?php echo format_date($ncTrackerEntry->getCreatedAt('U'), 'P') ?>
          </div>
        </div>
      </div>
    </fieldset>

    <ul class="sf_admin_actions">
      <li class="sf_admin_action_list"><?php echo link_to(__('Go back to list'), '@nc_tracker_entry') ?></li>
    </ul>
  </div>
</div>