<h2><?php echo __('Instructions', 'rishi-companion'); ?></h2>

<p>
	<?php echo __('After installing and activating the Customizer Reset extension you will be able to configure it from this location:', 'rishi-companion') ?>
</p>

<ul class="rt-modal-list">
	<li>
		<h4><?php echo __('Customizer', 'rishi-companion') ?></h4>
		<i>
		<?php
			echo sprintf(
				__('Navigate to %s and customize the notification to meet your needs.', 'rishi-companion'),
				sprintf(
					'<code>%s</code>',
					__('Customizer ➝ Customizer Reset', 'rishi-companion')
				)
			);
		?>
		</i>
	</li>
</ul>