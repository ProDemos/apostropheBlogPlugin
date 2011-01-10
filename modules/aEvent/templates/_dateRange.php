<?php // *** This is used in more than one place *** ?>
<?php // * Please keep it simple and don't add structural markup ?>
<?php // * The "ifs" here are carefully chosen to cover all of the possible ?>
<?php //   scenarios re: when to show the end date and when to show the times ?>
<?php // * The format_date helper automatically I18Ns in a reasonable fashion. ?>

<?php use_helper('Date') ?>
<?php
  // Compatible with sf_escaping_strategy: true
  $aEvent = isset($aEvent) ? $sf_data->getRaw('aEvent') : null;
?>

<?php // The -> syntax is compatible with both Doctrine objects and ?>
<?php // Zend Lucene results, I pass both to this partial. Please don't ?>
<?php // change to the [] syntax ?>

<?php echo format_date($aEvent->start_date, 'D') ?>
<?php // Use strlen rather than is_null to cope with legacy data ?>
<?php if (strlen($aEvent->start_time)): ?>
  <?php echo format_date($aEvent->start_time, 't') ?>
<?php endif ?>
<?php if (($aEvent->start_date !== $aEvent->end_date) || ($aEvent->start_time !== $aEvent->end_time)): ?>
  <?php echo '&mdash;' ?>
  <?php echo $aEvent->start_date . ',' . $aEvent->end_date ?>
<?php endif ?>
<?php if ($aEvent->start_date !== $aEvent->end_date): ?>
  <?php echo format_date($aEvent->end_date, 'D') ?>
<?php endif ?>
<?php if (strlen($aEvent->end_time) && (($aEvent->start_date !== $aEvent->end_date) || ($aEvent->start_time !== $aEvent->end_time))): ?>
  <?php echo format_date($aEvent->end_time, 't') ?>
<?php endif ?>


<!-- end date range -->