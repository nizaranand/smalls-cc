<?php 
get_header();

if (have_posts()) 
{	while (have_posts())  
	{	art_post();
	
		$nPostID	=	get_the_ID();
		if	(	$nPostID	==	1556	)
			echo
				"<iframe	class	=	'calendar'
							style='border-width: 0pt;' src='https://www.google.com/calendar/b/0/embed?mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=9st6tsbkbuhreq6agrfdfk748o%40group.calendar.google.com&amp;color=%23711616&amp;src=g79di3vj0c69h0m64pekq7k3fo%40group.calendar.google.com&amp;color=%232F6309&amp;src=etnn6qg86874dv0kbinp2sk0s4%40group.calendar.google.com&amp;color=%23AB8B00&amp;ctz=America%2FNew_York' frameborder='0' scrolling='no' height='600'></iframe>
<a id='schedule' name='schedule'></a>
KEY: <span style='color: #00cc00;'>Classes in Studio 1</span> * <span style='color: #ff9900;'>Classes in Studio 2</span> *<span style='color: #c80000;'>Cancellations</span>";

		if	(	$nPostID	==	170	)
			echo
				"<iframe style='border-width: 0pt;' src='https://www.google.com/calendar/b/0/embed?mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=9sgkkp690bqf748ure7laoes08%40group.calendar.google.com&amp;color=%232952A3&amp;src=0gcefanhmns57memab5ptb752k%40group.calendar.google.com&amp;color=%23A32929&amp;ctz=America%2FNew_York' frameborder='0' scrolling='no' class='calendar' height='600'></iframe>";

		comments_template();
	}
}	else
{	art_not_found_msg();
}

get_footer();
?>
