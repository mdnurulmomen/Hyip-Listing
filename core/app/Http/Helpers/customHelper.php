<?php

use App\Advertisement;

function adHelper($sizeId)
{
	$allAdvertisements = Advertisement::where('size', $sizeId)->where('status', 1)->get();

	if(count($allAdvertisements) < 1){
		return "<a href='#' target='_blank'> <img class='img-fluid' src ='' alt='none'> </a>";
	}
	else{
		$randomAd = $allAdvertisements->random();
		
		if($randomAd->type=='banner'){

			$randomAd->increment('views');

			$imageSrc = asset('assets/front/images/advertisement/'.$randomAd->preview);


			return "<a href=".route('front.count_views', $randomAd->id)."  target='_blank'>
			<img class='img-fluid' src =$imageSrc alt='none'>
			</a>";
		}
		else{
			return $randomAd->script;
		}
	}

}