<?php if (self::$instanceCount<2): ?>
	<div id="asl_hidden_data">
		<svg style="position:absolute" height="0" width="0">
			<filter id="aslblur">
				<feGaussianBlur in="SourceGraphic" stdDeviation="4"/>
			</filter>
		</svg>
		<svg style="position:absolute" height="0" width="0">
			<filter id="no_aslblur"></filter>
		</svg>
	</div>
<?php endif; ?>