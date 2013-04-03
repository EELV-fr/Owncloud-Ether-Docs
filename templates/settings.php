<form id="files_etherpad" action="#" method="post">
    <fieldset class="personalblock">
        <strong><?php echo $l->t('Collaborative Documents');?></strong>
        <p>
            <label for="files_etherpad_host"><?php echo $l->t('Etherpad Host');?></label>
            <input type="text" id="files_etherpad_host" name="files_etherpad_host"
                value="<?php echo $_['files_etherpad_host']; ?>" />
                <em><?php echo $l->t('ex:'); ?> http://lite.framapad.org</em>
        </p>
        <p>
            <label for="files_etherpad_calc_host"><?php echo $l->t('Ethercalc Host');?></label>
            <input type="text" id="files_etherpad_calc_host" name="files_etherpad_calc_host"
                value="<?php echo $_['files_etherpad_calc_host']; ?>" />
                <em><?php echo $l->t('ex:'); ?> http://framacalc.org</em>
        </p>
        <input type="submit" value="<?php echo $l->t('Save');?>" />
    </fieldset>
</form>
