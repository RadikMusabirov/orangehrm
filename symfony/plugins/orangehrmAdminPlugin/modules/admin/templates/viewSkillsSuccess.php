<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 *
 */
?>

<?php use_stylesheet('../orangehrmAdminPlugin/css/viewSkillsSuccess'); ?>

<?php echo isset($templateMessage) ? templateMessage($templateMessage) : ''; ?>

<div id="saveFormDiv">
    <div class="outerbox">

    <div class="mainHeading"><h2 id="saveFormHeading">Add Skill</h2></div>

        <form name="frmSave" id="frmSave" method="post" action="<?php echo url_for('admin/viewSkills'); ?>">
            
            <?php echo $form['_csrf_token']; ?>
            
            <?php echo $form['id']->render(); ?>
            
            <?php echo $form['name']->renderLabel(__('Name'). ' <span class="required">*</span>'); ?>
            <?php echo $form['name']->render(array("class" => "formInputText", "maxlength" => 120)); ?>
            <div class="errorHolder"></div>
            <br class="clear"/>
            
            <?php echo $form['description']->renderLabel(__('Description')); ?>
            <?php echo $form['description']->render(array("class" => "formInputText")); ?>
            <div class="errorHolder"></div>
            <br class="clear"/>
            
            <div class="formbuttons">
                <input type="button" class="savebutton" name="btnSave" id="btnSave"
                       value="<?php echo __('Save'); ?>"
                       title="<?php echo __('Save'); ?>"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                <input type="button" id="btnCancel" class="cancelbutton" value="<?php echo __('Cancel'); ?>"/>
            </div>

        </form>
    
    </div>
    
<div class="paddingLeftRequired"><span class="required">*</span> <?php echo __(CommonMessages::REQUIRED_FIELD); ?></div>    
    
</div> <!-- saveFormDiv -->

<!-- Listi view -->

<div id="recordsListDiv">
    <div class="outerbox">
        <form name="frmList" id="frmList" method="post" action="<?php echo url_for('admin/deleteSkills'); ?>">
            <div class="mainHeading"><h2><?php echo __('Skills'); ?></h2></div>

            <div class="actionbar" id="listActions">
                <div class="actionbuttons">
                    <input type="button" class="addbutton" id="btnAdd" 
                           onmouseover="moverButton(this);" onmouseout="moutButton(this);" value="<?php echo __('Add'); ?>" title="<?php echo __('Add'); ?>"/>
                    <input type="button" class="delbutton" id="btnDel" 
                           onmouseover="moverButton(this);" onmouseout="moutButton(this);" value="<?php echo __('Delete'); ?>" title="<?php echo __('Delete'); ?>"/>
                </div>
            </div>

            <table width="550" cellspacing="0" cellpadding="0" class="data-table" id="recordsListTable">
                <thead>
                    <tr>
                        <td class="check"><input type="checkbox" id="checkAll" class="checkbox" /></td>
                        <td><?php echo __('Name'); ?></td>
                        <td><?php echo __('Description'); ?></td>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($records as $record): ?>
                    
                    <tr>
                        <td class="check">
                            <input type="checkbox" class="checkbox" name="chkListRecord[]" value="<?php echo $record->getId(); ?>" />
                        </td>
                        <td class="tdName tdValue">
                            <a href="#"><?php echo $record->getName(); ?></a>
                        </td>
                        <td class="tdValue">
                            <?php echo $record->getDescription(); ?> 
                        </td>
                    </tr>
                    
                    <?php endforeach; ?>
                    
                    <?php if (count($records) == 0) : ?>
                    <tr>
                        <td>
                            <?php echo __(TopLevelMessages::NO_RECORDS_FOUND); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <?php endif; ?>
                    
                </tbody>
            </table>
        </form>
    </div>
</div> <!-- recordsListDiv -->    


<?php use_javascript('../orangehrmAdminPlugin/js/viewSkillsSuccess'); ?>

<script type="text/javascript">
//<![CDATA[	    
 
    var recordsCount = <?php echo count($records);?>;
   
    var recordKeyId = "skill_id";
   
    var saveFormFieldIds = new Array();
    saveFormFieldIds[0] = "skill_name";
    saveFormFieldIds[1] = "skill_description";
    
    var urlForExistingNameCheck = '<?php echo url_for('admin/checkSkillNameExistence'); ?>';
    
    var lang_addFormHeading = "<?php echo __('Add Skill'); ?>";
    var lang_editFormHeading = "<?php echo __('Edit Skill'); ?>";
    
    var lang_nameIsRequired = '<?php echo __(ValidationMessages::REQUIRED); ?>';
    var lang_descLengthExceeded = '<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 250)); ?>';
    var lang_nameExists = '<?php echo __(ValidationMessages::ALREADY_EXISTS); ?>';
    var skills = <?php echo str_replace('&#039;', "'", $form->getSkillListAsJson()) ?> ;
    var skillList = eval(skills);
    
//]]>	
</script> 