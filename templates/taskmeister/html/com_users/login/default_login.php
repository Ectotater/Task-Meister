<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

?>

<div class="login<?php echo $this->pageclass_sfx; ?> text-center">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		<div class="login-description">
	<?php endif; ?>
	<?php if ($this->params->get('logindescription_show') == 1) : ?>
		<?php echo $this->params->get('login_description'); ?>
	<?php endif; ?>
	<?php if ($this->params->get('login_image') != '') : ?>
		<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>" />
	<?php endif; ?>
	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		</div>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal well">
		<fieldset>
			<?php echo $this->form->renderFieldset('credentials'); ?>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn bgAlt login-button">
						<?php echo JText::_('JLOGIN'); ?>
					</button>
				</div>
			</div>
			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
				<div class="control-group flex">
					<div class="control-label">
						<label for="remember">
							<?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME'); ?>
						</label>
					</div>
					<div class="controls">
						<input id="remember" type="checkbox" name="remember" class="inputbox" value="yes" />
					</div>
				</div>
			<?php endif; ?>
			<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
			<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
	</form>
</div>
<div>
	<ul class="nav nav-tabs nav-stacked">
		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
		<?php if ($usersConfig->get('allowUserRegistration')) : ?>
			<li>
				<a class="m-2" href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<span class="badge bgAlt p-1">Create an Account</span>
				</a>
			</li>
		<?php endif; ?>
		<li>
			<a class="m-2" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
				<span class="badge bgAlt p-1"><?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></span>
			</a>
		</li>
		<li>
			<a class="m-2" href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
				<span class="badge bgAlt p-1"><?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></span>
			</a>
		</li>
	</ul>
</div>
