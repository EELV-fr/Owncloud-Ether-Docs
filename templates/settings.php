<form id="files_etherpad" action="#" method="post">
    <fieldset class="personalblock">
        <strong>Files Etherpad</strong>
        <p>
            <label for="files_etherpad_host"><?php echo $l->t('Etherpad Host');?></label>
            <input type="text" id="files_etherpad_host" name="files_etherpad_host"
                value="<?php echo $_['files_etherpad_host']; ?>" />
                <em>ex:  http://lite.framapad.org</em>

        <input type="submit" value="<?php echo $l->t('Save');?>" />
    </fieldset>
</form>
<?php ?>
