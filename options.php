<?php

// Theme settings
if (class_exists('CSF')) {
	$prefix = 'pidogame_framework';

	// Create options
	CSF::createOptions($prefix, array(
		'framework_title'	=>	'تنظیمات پیدوگیم',
		'menu_title'		=>	'تنظیمات پیدوگیم',
		'menu_slug'			=>	'pidogame-framework',
		'footer_credit'		=>	'پنل تنظیمات پیدوگیم طراحی شده توسط ردپا'
	));

	// Create header section
	CSF::createSection($prefix, array(
		'id'			=>	'header',
		'title'			=>	'تنظیمات سربرگ',
	));

	// Create header logo section
	CSF::createSection($prefix, array(
		'id'			=>	'header-logo',
		'parent'		=>	'header',
		'title'			=>	'تنظیمات سربرگ',
		'fields'		=>	array(
			// Create desktop logo
			array(
				'id'    	=>	'opt-header-desktop-logo',
				'type'  	=>	'media',
				'title'		=>	'لوگوی سربرگ در نمایش دسکتاپ',
				'subtitle'	=>	'این لوگو در زمان نمایش در حالت دسکتاپ در سربرگ نمایش داده خواهد شد. بهتر است از یک تصویر باکیفیت و بدون حاشیه استفاده کنید.',
				'library'	=>	'image'
			),
			// Create desktop logo height
			array(
				'id'    		=>	'opt-header-desktop-logo-height',
				'type'  		=>	'select',
				'title'			=>	'ارتفاع لوگوی سربرگ در نمایش دسکتاپ',
				'subtitle'		=>	'از این قسمت ارتفاع لوگوی سربرگ در حالت دسکتاپ را انتخاب کنید. بسته به اندازه تصویر می توان به بهترین نتیجه رسید.',
				'placeholder'	=>	'انتخاب کنید...',
				'options'     	=>	array(
					'h-10px'  		=>	'10px',
					'h-15px'  		=>	'15px',
					'h-20px'  		=>	'20px',
					'h-25px'  		=>	'25px',
					'h-30px'  		=>	'30px',
					'h-35px'  		=>	'35px',
					'h-40px'  		=>	'40px',
					'h-45px'  		=>	'45px',
					'h-50px'  		=>	'50px',
					'h-55px'  		=>	'55px',
					'h-60px'  		=>	'60px',
					'h-65px'  		=>	'65px',
					'h-70px'  		=>	'70px',
					'h-75px'  		=>	'75px',
					'h-80px'  		=>	'80px',
					'h-85px'  		=>	'85px',
					'h-90px'  		=>	'90px',
					'h-95px'  		=>	'95px',
					'h-100px'  		=>	'100px',
					'h-125px'  		=>	'125px',
					'h-150px'  		=>	'150px',
					'h-175px'  		=>	'175px',
					'h-200px'  		=>	'200px',
					'h-225px'  		=>	'225px',
					'h-250px'  		=>	'250px',
					'h-275px'  		=>	'275px',
					'h-300px'  		=>	'300px',
					'h-325px'  		=>	'325px',
					'h-350px'  		=>	'350px',
					'h-375px'  		=>	'375px',
					'h-400px'  		=>	'400px'
				)
			),
			// Create mobile logo
			array(
				'id'    	=>	'opt-header-mobile-logo',
				'type'  	=>	'media',
				'title'		=>	'لوگوی سربرگ در نمایش موبایل',
				'subtitle'	=>	'این لوگو در زمان نمایش در حالت موبایل در سربرگ نمایش داده خواهد شد. بهتر است از یک تصویر باکیفیت و بدون نوشته و تنها به صورت نمایی استفاده کنید.',
				'library'	=>	'image'
			),
			// Create mobile logo height
			array(
				'id'    		=>	'opt-header-mobile-logo-height',
				'type'  		=>	'select',
				'title'			=>	'ارتفاع لوگوی سربرگ در نمایش موبایل',
				'subtitle'		=>	'از این قسمت ارتفاع لوگوی سربرگ در حالت موبایل را انتخاب کنید. بسته به اندازه تصویر می توان به بهترین نتیجه رسید.',
				'placeholder'	=>	'انتخاب کنید...',
				'options'     	=>	array(
					'h-10px'  		=>	'10px',
					'h-15px'  		=>	'15px',
					'h-20px'  		=>	'20px',
					'h-25px'  		=>	'25px',
					'h-30px'  		=>	'30px',
					'h-35px'  		=>	'35px',
					'h-40px'  		=>	'40px',
					'h-45px'  		=>	'45px',
					'h-50px'  		=>	'50px',
					'h-55px'  		=>	'55px',
					'h-60px'  		=>	'60px',
					'h-65px'  		=>	'65px',
					'h-70px'  		=>	'70px',
					'h-75px'  		=>	'75px',
					'h-80px'  		=>	'80px',
					'h-85px'  		=>	'85px',
					'h-90px'  		=>	'90px',
					'h-95px'  		=>	'95px',
					'h-100px'  		=>	'100px',
					'h-125px'  		=>	'125px',
					'h-150px'  		=>	'150px',
					'h-175px'  		=>	'175px',
					'h-200px'  		=>	'200px',
					'h-225px'  		=>	'225px',
					'h-250px'  		=>	'250px',
					'h-275px'  		=>	'275px',
					'h-300px'  		=>	'300px',
					'h-325px'  		=>	'325px',
					'h-350px'  		=>	'350px',
					'h-375px'  		=>	'375px',
					'h-400px'  		=>	'400px'
				)
			),
		)
	));

	// Create header cart section
	CSF::createSection($prefix, array(
		'id'			=>	'header-cart',
		'title'			=>	'تنظیمات سبد خرید سربرگ',
		'parent'		=>	'header',
		'fields'		=>	array(
			// Create on or off
			array(
				'id'    		=>	'opt-header-cart-switcher',
				'type'  		=>	'switcher',
				'title'			=>	'نمایش سبد خرید',
				'subtitle'		=>	'با فعال بودن این گزینه سبد خرید در سربرگ وب سایت نمایش داده خواهد شد.',
				'text_width'	=>	80,
				'default'		=>	true
			),
			// Create title
			array(
				'id'    		=>	'opt-header-cart-title',
				'type'  		=>	'text',
				'title'			=>	'عنوان سبد خرید',
				'subtitle'		=>	'این متن در هنگام کلیک بر روی سبد خرید در بالای جعبه نمایش داده خواهد شد.'
			),
			// Create cart button
			array(
				'id'    		=>	'opt-header-cart-cart-button',
				'type'  		=>	'text',
				'title'			=>	'متن دکمه سبد خرید',
				'subtitle'		=>	'این متن درون دکمه پایین جعبه که به صفحه سبد خرید لینک شده است قرار داده خواهد شد.'
			),
			// Create checkout button
			array(
				'id'    		=>	'opt-header-cart-checkout-button',
				'type'  		=>	'text',
				'title'			=>	'متن دکمه تسویه حساب',
				'subtitle'		=>	'این متن درون دکمه پایین جعبه که به صفحه تسویه حساب لینک شده است قرار داده خواهد شد.'
			),
			// Create empty title
			array(
				'id'    		=>	'opt-header-cart-empty-title',
				'type'  		=>	'text',
				'title'			=>	'عنوان سبد خرید خالی',
				'subtitle'		=>	'در صورتی که سبد خرید کاربر خالی باشد این عنوان برای او نمایش داده خواهد شد.'
			),
			// Create empty subtitle
			array(
				'id'    		=>	'opt-header-cart-empty-subtitle',
				'type'  		=>	'text',
				'title'			=>	'زیر عنوان سبد خرید خالی',
				'subtitle'		=>	'در صورتی که سبد خرید کاربر خالی باشد این زیر عنوان برای او نمایش داده خواهد شد.'
			),
		)
	));

	// Create header notifications section
	CSF::createSection($prefix, array(
		'id'			=>	'header-notifications',
		'title'			=>	'تنظیمات اعلان های سربرگ',
		'parent'		=>	'header',
		'fields'		=>	array(
			// Create on or off
			array(
				'id'    		=>	'opt-header-notifications-switcher',
				'type'  		=>	'switcher',
				'title'			=>	'نمایش اعلان ها',
				'subtitle'		=>	'با فعال بودن این گزینه اعلان ها در سربرگ وب سایت نمایش داده خواهد شد.',
				'text_width'	=>	80,
				'default'		=>	true
			),
			// Create notifications header image
			array(
				'id'    	=>	'opt-header-notifications-header-image',
				'type'  	=>	'media',
				'title'		=>	'تصویر بالای قسمت اعلان ها',
				'subtitle'	=>	'این تصویر در بالای قسمت اعلان های سربرگ سایت نمایش داده خواهد شد. بهتر از یک تصویر سبک و ساده برای این قسمت استفاده شود.',
				'library'	=>	'image'
			),
			// Create notifications title
			array(
				'id'    		=>	'opt-header-notifications-title',
				'type'  		=>	'text',
				'title'			=>	'عنوان اعلان ها',
				'subtitle'		=>	'این متن در هنگام کلیک بر روی اعلان ها در بالای جعبه نمایش داده خواهد شد.'
			),
			// Create notifications number
			array(
				'id'    		=>	'opt-header-notifications-number',
				'type'  		=>	'spinner',
				'title'			=>	'تعداد اعلان ها',
				'subtitle'		=>	'در این قسمت مشخص کنید چه تعدادی اعلانی در جعبه نمایش داده شود. بهتر است از یک عدد متوسط استفاده کنید.',
				'default'		=>	7,
				'min'			=>	1,
				'max'			=>	50
			),
			// Create notifications link
			array(
				'id'    		=>	'opt-header-notifications-link',
				'type'  		=>	'link',
				'title'			=>	'لینک صفحه اعلان ها',
				'subtitle'		=>	'در پایین جعبه لینکی به صفحه اعلانات قرار داده شده است که می توانید آن را شخصی سازی کنید.'
			),
			// Create notifications empty title
			array(
				'id'    		=>	'opt-header-notifications-empty-title',
				'type'  		=>	'text',
				'title'			=>	'عنوان در حالت خالی',
				'subtitle'		=>	'این عنوان زمانی که اعلانی برای نمایش وجود نداشته باشید نشان داده خواهد شد.'
			),
			// Create notifications empty title
			array(
				'id'    		=>	'opt-header-notifications-empty-subtitle',
				'type'  		=>	'text',
				'title'			=>	'زیر عنوان در حالت خالی',
				'subtitle'		=>	'این زیر عنوان زمانی که اعلانی برای نمایش وجود نداشته باشید نشان داده خواهد شد.'
			),
			// Create notifications header image
			array(
				'id'    	=>	'opt-header-notifications-empty-image',
				'type'  	=>	'media',
				'title'		=>	'تصویر در حالت خالی',
				'subtitle'	=>	'این تصویر زمانی که اعلانی برای نمایش وجود نداشته باشید نشان داده خواهد شد.',
				'library'	=>	'image'
			),
			// Create font size
			array(
				'id'    		=>	'opt-header-notifications-fs',
				'type'  		=>	'select',
				'title'			=>	'اندازه قلم متن اعلان',
				'subtitle'		=>	'اندازه متن محتویات اعلان ها را انتخاب کنید. هرچه این عدد کمتر باشد، متن بزرگ تر خواهد شد.',
				'placeholder'	=>	'انتخاب کنید...',
				'options'     	=>	array(
					'fs-1'  		=>	'Font size 1',
					'fs-2'  		=>	'Font size 2',
					'fs-3'  		=>	'Font size 3',
					'fs-4'  		=>	'Font size 4',
					'fs-5'  		=>	'Font size 5',
					'fs-6'  		=>	'Font size 6',
					'fs-7'  		=>	'Font size 7',
					'fs-8'  		=>	'Font size 8',
					'fs-9'  		=>	'Font size 9',
					'fs-10'  		=>	'Font size 10'
				)
			),
			// Create font size
			array(
				'id'    		=>	'opt-header-notifications-lh',
				'type'  		=>	'select',
				'title'			=>	'فاصله خطوط متن اعلان',
				'subtitle'		=>	'فاصله خطوط محتویات اعلان ها را انتخاب کنید..',
				'placeholder'	=>	'انتخاب کنید...',
				'options'     	=>	array(
					'lh-1'  		=>	'1',
					'lh-sm'  		=>	'1.25',
					'lh-base'  		=>	'1.5',
					'lh-lg'  		=>	'1.75',
					'lh-xl'  		=>	'2',
					'lh-xxl'  		=>	'2.25'
				)
			),
			// Create notifications close button
			array(
				'id'    		=>	'opt-header-notifications-close-button',
				'type'  		=>	'text',
				'title'			=>	'متن دکمه بستن اعلان',
				'subtitle'		=>	'یک دکمه برای بستن اعلان در زیر اعلان نمایش داده خواهد شد. متن این دکمه را مشخص کنید.'
			),
		)
	));

	// Create header theme mode section
	CSF::createSection($prefix, array(
		'id'			=>	'header-mode',
		'title'			=>	'تنظیمات پوسته سایت سربرگ',
		'parent'		=>	'header',
		'fields'		=>	array(
			// Create on or off
			array(
				'id'    		=>	'opt-header-mode-switcher',
				'type'  		=>	'switcher',
				'title'			=>	'نمایش تغییر دهنده پوسته سایت',
				'subtitle'		=>	'با فعال بودن این گزینه تغییر دهنده پوسته سایت در سربرگ وب سایت نمایش داده خواهد شد.',
				'text_width'	=>	80,
				'default'		=>	true
			),
		)
	));

	// Create header user section
	CSF::createSection($prefix, array(
		'id'			=>	'header-user',
		'title'			=>	'تنظیمات کاربر سربرگ',
		'parent'		=>	'header',
		'fields'		=>	array(
			// Create wallet on or off
			array(
				'id'    		=>	'opt-header-user-wallet-switcher',
				'type'  		=>	'switcher',
				'title'			=>	'نمایش کیف پول کاربر',
				'subtitle'		=>	'با فعال بودن این گزینه کیف پول کاربر و موجودی آن در فهرست کاربر نمایش داده خواهد شد.',
				'text_width'	=>	80,
				'default'		=>	true
			),
			// Create wallet link
			array(
				'id'    		=>	'opt-header-user-wallet-link',
				'type'  		=>	'link',
				'title'			=>	'متن و لینک کیف پول کاربر',
				'subtitle'		=>	'یک متن و لینک برای نمایش به عنوان آیتم کیف پول کاربر وارد کنید.'
			),
			// Create theme switcher on or off
			array(
				'id'    		=>	'opt-header-user-theme-switcher',
				'type'  		=>	'switcher',
				'title'			=>	'نمایش تغییر دهنده پوسته',
				'subtitle'		=>	'با فعال بودن این گزینه تغییر دهنده پوسته در پایین فهرست کاربر نمایش داده خواهد شد.',
				'text_width'	=>	80,
				'default'		=>	true
			),
			// Create theme switcher label
			array(
				'id'    		=>	'opt-header-user-theme-label',
				'type'  		=>	'text',
				'title'			=>	'متن تغییر دهنده پوسته',
				'subtitle'		=>	'یک متن برای تغییر دهنده پوسته سایت واقع در زیر فهرست کاربری سربرگ وارد کنید.'
			),
			// Create login link
			array(
				'id'    		=>	'opt-header-user-login-link',
				'type'  		=>	'link',
				'title'			=>	'متن و لینک دکمه ورود به سایت',
				'subtitle'		=>	'یک متن و لینک برای دکمه ورود به سایت وارد کنید.'
			),
			// Create sign up link
			array(
				'id'    		=>	'opt-header-user-sign-up-link',
				'type'  		=>	'link',
				'title'			=>	'متن و لینک دکمه ثبت نام',
				'subtitle'		=>	'یک متن و لینک برای دکمه ثبت نام وارد کنید.'
			),
		)
	));

	// Create footer section
	CSF::createSection($prefix, array(
		'id'			=>	'footer',
		'title'			=>	'تنظیمات پاورقی',
		'fields'		=>	array(
			// Create copyright text
			array(
				'id'    	=>	'opt-footer-copyright',
				'type'  	=>	'text',
				'title'		=>	'متن کپی رایت',
				'subtitle'	=>	'این متن در قسمت پاورقی وب سایت نمایش داده خواهد شد.'
			),
			// Create footer menu help
			array(
				'type'    	=> 	'notice',
				'style'   	=> 	'info',
				'content' 	=> 	'برای تغییر فهرست پاورقی تنها کافی است از قسمت نمایش به قسمت فهرست ها رفته و یک فهرست جدید ایجاد کنید و مکان نمایش آن را بر روی فهرست پاورقی قرار دهید. توجه داشته باشید که این فهرست تنها یک سطحی بوده و امکان قرار دادن فهرست چند سطحی در آن وجود ندارد.',
			),
		)
	));

	// Create comments section
	CSF::createSection($prefix, array(
		'id'			=>	'comments',
		'title'			=>	'تنظیمات دیدگاه ها',
		'fields'		=>	array(
			// Create rules title
			array(
				'id'    	=>	'opt-comments-rules-title',
				'type'  	=>	'text',
				'title'		=>	'عنوان قسمت قوانین دیدگاه',
				'subtitle'	=>	'عنوان قسمت قوانین دیدگاه که برای کاربر نمایش داده می شود را وارد کنید.'
			),
			// Create rules content
			array(
				'id'    	=>	'opt-comments-rules-content',
				'type'  	=>	'wp_editor',
				'title'		=>	'قوانین دیدگاه ها',
				'subtitle'	=>	'قوانین دیدگاه های سایت را در این قسمت وارد کنید.',
				'sanitize' 	=> 	false
			),
		)
	));

	// Create like search product section
	CSF::createSection($prefix, array(
		'id'			=>	'search-product-likes',
		'title'			=>	'جستجوهای پیشنهادی محصولات',
		'fields'		=>	array(
			array(
				'id'          => 'search-product-likes-field',
				'type'        => 'select',
				'title'       => 'محصولات پیشنهادی جهت نمایش در نتایج جستجو',
				'placeholder' => 'محصولات پیشنهادی را انتخاب کنید.',
				'chosen'      => true,
				'multiple'    => true,
				'options'     => 'post_types',
				'query_args'  => array(
					'post_type' => 'products',
				),
			),
		)
	));
}

// Product settings
if (class_exists('CSF')) {
	$prefix = 'pidogame_framework_products';
	CSF::createMetabox($prefix, array(
		'title'     =>	'تنظیمات محصول',
		'post_type' =>	'product'
	));

	// Create a section
	CSF::createSection($prefix, array(
		'fields'	=>	array(
			// Create product type
			array(
				'id'		=>	'opt-product-type',
				'type'		=>	'radio',
				'title'		=>	'نوع محصول',
				'options'	=>	array(
					'game'		=>	'فروش بازی و محصول',
					'gift'		=>	'فروش گیفت کارت',
					'item'		=>	'فروش آیتم درون بازی'
				),
				'default'	=>	'game'
			),
			// Create subtitle text
			array(
				'id'    	=>	'opt-product-subtitle',
				'type'  	=>	'text',
				'title'		=>	'زیرنویس محصول'
			),
			// Create wallpaper image
			array(
				'id'    	=>	'opt-product-wallpaper-image',
				'type'  	=>	'media',
				'title'		=>	'تصویر پس زمینه محصول',
				'library'	=>	'image'
			),
			// Create trailer image
			array(
				'id'    	=>	'opt-product-trailer-image',
				'type'  	=>	'media',
				'title'		=>	'تصویر پس زمینه تریلر',
				'library'	=>	'image'
			),
			// Create trailer
			array(
				'id'    	=>	'opt-product-trailer-video',
				'type'  	=>	'text',
				'title'		=>	'لینک ویدیو تریلر محصول'
			),
			// Create simple product title
			array(
				'id'    	=>	'opt-product-simple-title',
				'type'  	=>	'text',
				'title'		=>	'عنوان محصول ساده'
			),
			// Create simple product subtitle
			array(
				'id'    	=>	'opt-product-simple-subtitle',
				'type'  	=>	'text',
				'title'		=>	'زیر عنوان محصول ساده'
			),
			// Create buy modal form title
			array(
				'id'    	=>	'opt-product-modal-form-title',
				'type'  	=>	'text',
				'title'		=>	'عنوان مودال فرم افزودن به سبد خرید'
			),
			// Create buy modal form subtitle
			array(
				'id'    	=>	'opt-product-modal-form-subtitle',
				'type'  	=>	'text',
				'title'		=>	'زیر عنوان مودال فرم افزودن به سبد خرید'
			),
			// Create buy modal form warning title
			array(
				'id'    	=>	'opt-product-modal-form-warning-title',
				'type'  	=>	'text',
				'title'		=>	'عنوان قسمت اطلاعات مودال افزودن به سبد خرید'
			),
			// Create buy modal form warning content
			array(
				'id'    	=>	'opt-product-modal-form-warning-content',
				'type'  	=>	'wp_editor',
				'title'		=>	'محتوای قسمت اطلاعات مودال افزودن به سبد خرید',
				'sanitize' 	=> 	false
			),
			// Create gift card image
			array(
				'id'    	=>	'opt-product-gift-card-image',
				'type'  	=>	'media',
				'title'		=>	'تصویر بالای گیفت کارت ها',
				'library'	=>	'image'
			),
			// Create gift card image height
			array(
				'id'    		=>	'opt-product-gift-card-image-height',
				'type'  		=>	'select',
				'title'			=>	'ارتفاع تصویر گیفت کارت',
				'placeholder'	=>	'انتخاب کنید...',
				'options'     	=>	array(
					'h-10px'  		=>	'10px',
					'h-15px'  		=>	'15px',
					'h-20px'  		=>	'20px',
					'h-25px'  		=>	'25px',
					'h-30px'  		=>	'30px',
					'h-35px'  		=>	'35px',
					'h-40px'  		=>	'40px',
					'h-45px'  		=>	'45px',
					'h-50px'  		=>	'50px',
					'h-55px'  		=>	'55px',
					'h-60px'  		=>	'60px',
					'h-65px'  		=>	'65px',
					'h-70px'  		=>	'70px',
					'h-75px'  		=>	'75px',
					'h-80px'  		=>	'80px',
					'h-85px'  		=>	'85px',
					'h-90px'  		=>	'90px',
					'h-95px'  		=>	'95px',
					'h-100px'  		=>	'100px',
					'h-125px'  		=>	'125px',
					'h-150px'  		=>	'150px',
					'h-175px'  		=>	'175px',
					'h-200px'  		=>	'200px',
					'h-225px'  		=>	'225px',
					'h-250px'  		=>	'250px',
					'h-275px'  		=>	'275px',
					'h-300px'  		=>	'300px',
					'h-325px'  		=>	'325px',
					'h-350px'  		=>	'350px',
					'h-375px'  		=>	'375px',
					'h-400px'  		=>	'400px'
				)
			),
			// Create gift card front color
			array(
				'id'        	=>	'opt-product-gift-card-front-color',
				'type'      	=>	'color_group',
				'title'     	=>	'رنگ روی گیفت کارت ها',
				'options'   	=>	array(
					'color-1'		=>	'رنگ اول',
					'color-2'		=>	'رنگ دوم',
					'color-3'		=>	'رنگ سوم',
					'color-4'		=>	'رنگ چهارم',
					'color-5'		=>	'رنگ پنجم'
				)
			),
			// Create gift card front image
			array(
				'id'    	=>	'opt-product-gift-card-front-image',
				'type'  	=>	'media',
				'title'		=>	'تصویر پس زمینه روی گیفت کارت',
				'library'	=>	'image'
			),
			// Create gift card back color
			array(
				'id'        	=>	'opt-product-gift-card-back-color',
				'type'      	=>	'color_group',
				'title'     	=>	'رنگ روی گیفت کارت ها',
				'options'   	=>	array(
					'color-1'		=>	'رنگ اول',
					'color-2'		=>	'رنگ دوم',
					'color-3'		=>	'رنگ سوم',
					'color-4'		=>	'رنگ چهارم',
					'color-5'		=>	'رنگ پنجم'
				)
			),
			// Create gift card back image
			array(
				'id'    	=>	'opt-product-gift-card-back-image',
				'type'  	=>	'media',
				'title'		=>	'تصویر پس زمینه پشت گیفت کارت',
				'library'	=>	'image'
			),
			// Create gift card back line color
			array(
				'id'        =>	'opt-product-gift-card-line-color',
				'type'      =>	'color',
				'title'     =>	'رنگ نوار بالای پشت گیفت کارت ها',
				'default'	=>	'#000000'
			),
		)
	));
}

// Notifications settings
if (class_exists('CSF')) {
	$prefix = 'pidogame_framework_notifications';
	CSF::createMetabox($prefix, array(
		'title'     =>	'تنظیمات اعلان',
		'post_type' =>	'notifications'
	));

	// Create a section
	CSF::createSection($prefix, array(
		'fields'	=>	array(
			// Create subtitle
			array(
				'id'    	=>	'opt-notifications-subtitle',
				'type'  	=>	'text',
				'title'		=>	'زیر عنوان اعلان'
			),
			// Create icon
			array(
				'id'    	=>	'opt-notifications-icon',
				'type'  	=>	'code_editor',
				'title'		=>	'آیکون SVG',
				'sanitize' 	=> 	false
			),
			// Create color
			array(
				'id'    		=>	'opt-notifications-color',
				'type'  		=>	'select',
				'title'			=>	'رنگ آیکون اعلان',
				'placeholder'	=>	'انتخاب کنید...',
				'options'     	=>	array(
					'primary'  		=>	'اولیه',
					'success'  		=>	'موفقیت',
					'info'  		=>	'اطلاعات',
					'warning'  		=>	'هشدار',
					'danger'  		=>	'خطر',
					'dark'  		=>	'تاریک'
				)
			),
			// Create important
			array(
				'id'    		=>	'opt-notifications-important',
				'type'  		=>	'switcher',
				'title'			=>	'اعلان مهم',
				'subtitle'		=>	'در صورتی که این اعلان یک اعلان مهم است این مورد را فعال کنید.',
				'text_width'	=>	80,
				'default'		=>	false
			),
		)
	));
}

// Menu settings
if (class_exists('CSF')) {
	$prefix = 'pidogame_framework_menu';
	CSF::createNavMenuOptions($prefix, array(
		'data_type'		=>	'serialize',
	));
	CSF::createSection($prefix, array(
		'fields'	=>	array(
			// Create mega menu
			array(
				'id'    	=>	'opt-menu-mega',
				'type'  	=>	'checkbox',
				'title' 	=>	'مگامنو',
				'label'   	=>	'فعال سازی مگامنو',
				'default' 	=>	false
			),
			// Create icon
			array(
				'id'    	=>	'opt-menu-icon',
				'type'  	=>	'code_editor',
				'title'		=>	'آیکون SVG',
				'sanitize' 	=> 	false
			),
			// Create badge label
			array(
				'id'    	=>	'opt-menu-badge',
				'type'  	=>	'text',
				'title'		=>	'متن نشان'
			),
			// Create badge color
			array(
				'id'    		=>	'opt-menu-badge-color',
				'type'  		=>	'select',
				'title'			=>	'رنگ نشان',
				'placeholder'	=>	'انتخاب کنید...',
				'options'     	=>	array(
					'white'  		=>	'سفید',
					'primary'  		=>	'اولیه',
					'light'  		=>	'روشن',
					'secondary'  	=>	'ثانویه',
					'success'  		=>	'موفقیت',
					'info'  		=>	'اطلاعات',
					'warning'  		=>	'هشدار',
					'danger'  		=>	'خطر',
					'dark'  		=>	'تاریک',
					'light-primary'	=>	'اولیه روشن',
					'light-success'	=>	'موفقیت روشن',
					'light-info'	=>	'اطلاعات روشن',
					'light-warning'	=>	'هشدار روشن',
					'light-danger'	=>	'خطر روشن',
					'light-dark'	=>	'تاریک روشن'
				)
			),
		)
	));
}
