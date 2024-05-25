<style>
	*{
		text-transform: none;
	}
	.bg-primary{
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}
	.text-primary{
		color: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}

	.btn-primary{
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}

	.badge-primary{
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}

	.btn-bg-primary{
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
		color: white;
	}

	
	/* CSS for hiding the div on mobile devices */
    @media (max-width: 767px) {
      #mobilebreacump {
        display: none;

      }
	  #header{
		margin-top:-8px;
	  }
    }
</style>





<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				
					<?= $content ?>
				</div>