<div  class =  "shoe-size-chart" >

<?php
/* jonathan@smalls.cc   2012 May 28
Since this inclusion should exist only on product detail pages for shoes,
we can reasonably assume that it has a very narrow use. As such I am willing
to build some dependency on the current configuration of the product detail
page rather than building this script to stand completely alone.

Bear in mind that the needle variable in the STRPOS() search deliberately omits
the first letter of the word to avoid issues with capitalization.
*/
if (  strpos(  $szPostTitle,
               'omen'
            )  !==   false
   )
// Ladies Shoe Sizes
{  echo  "<ul>
         	<li>	English	</li>
         	<li>	2			</li>
         	<li> 	2.5		</li>
         	<li>	3			</li>
         	<li>	3.5		</li>
         	<li> 	4			</li>
         	<li> 	4.5		</li>
         	<li> 	5			</li>
         	<li> 	5.5		</li>
         	<li> 	6			</li>
         	<li>	6.5		</li>
         	<li> 	7			</li>
         	<li> 	7.5		</li>
         	<li> 	8			</li>
         </ul>
         
         <ul>
         	<li>	European	</li>
         	<li> 	34			</li>
         	<li> 	35			</li>
         	<li> 	35.5		</li>
         	<li> 	36			</li>
         	<li> 	37			</li>
         	<li> 	37.5		</li>
         	<li> 	38			</li>
         	<li> 	39			</li>
         	<li> 	39.5		</li>
         	<li> 	40			</li>
         	<li> 	40.5		</li>
         	<li> 	41			</li>
         	<li> 	42			</li>
         </ul>
         
         <ul>
         	<li> 	American	</li>
         	<li> 	4.5		</li>
         	<li> 	5			</li>
         	<li> 	5.5		</li>
         	<li> 	6			</li>
         	<li> 	6.5		</li>
         	<li> 	7			</li>
         	<li> 	7.5		</li>
         	<li> 	8			</li>
         	<li> 	8.5		</li>
         	<li> 	9			</li>
         	<li> 	9.5		</li>
         	<li> 	10			</li>
         	<li> 	10.5		</li>
         </ul>
         
         <ul>
         	<li> 	Japanese	</li>
         	<li> 	21.5		</li>
         	<li> 	22			</li>
         	<li> 	22.5		</li>
         	<li> 	23			</li>
         	<li> 	23			</li>
         	<li> 	23.5		</li>
         	<li> 	24			</li>
         	<li> 	24			</li>
         	<li> 	24.5		</li>
         	<li> 	25			</li>
         	<li> 	25.5		</li>
         	<li> 	26			</li>
         	<li> 	26.5		</li>
         </ul>";
}

if (  strpos(  $szPostTitle,
               'omen'
            )  ===   false
&&    strpos(  $szPostTitle,
               'hildren'
            )  ===   false
/*
&&    strpos(  $szPostTitle,
               'en'
            )  !==   false
*/
   )
//	Mens Shoe Sizes
{  echo  "<ul>
         	<li>	English	</li>
         	<li> 	6			</li>
         	<li> 	6.5 		</li>
         	<li>	7			</li>
         	<li> 	7.5		</li>
         	<li> 	8			</li>
         	<li> 	8.5		</li>
         	<li> 	9			</li>
         	<li> 	9.5		</li>
         	<li> 	10			</li>
         	<li> 	10.5		</li>
         	<li> 	11			</li>
         	<li> 	11.5		</li>
         	<li> 	12			</li>
         </ul>
         
         <ul>
         	<li>	European	</li>
         	<li> 	39.3		</li>
         	<li> 	40			</li>
         	<li> 	40.5		</li>
         	<li> 	41			</li>
         	<li> 	42			</li>
         	<li> 	42.5		</li>
         	<li> 	43			</li>
         	<li> 	44			</li>
         	<li> 	44.5		</li>
         	<li> 	45			</li>
         	<li> 	46			</li>
         	<li> 	46.5		</li>
         	<li> 	47			</li>
         </ul>
         
         <ul>
         	<li>	American	</li>
         	<li> 	7			</li>
         	<li> 	7.5		</li>
         	<li> 	8			</li>
         	<li>	8.5		</li>
         	<li>	9			</li>
         	<li> 	9.5		</li>
         	<li>	10 		</li>
         	<li>	10.5		</li>
         	<li> 	11			</li>
         	<li> 	11.5		</li>
         	<li> 	12			</li>
         	<li> 	12.5		</li>
         	<li>	13			</li>
         </ul>
         
         <ul>
         	<li>	Japanese	</li>
         	<li> 	24.5		</li>
         	<li> 	25			</li>
         	<li> 	25.5		</li>
         	<li> 	26			</li>
         	<li> 	26.5		</li>
         	<li> 	27			</li>
         	<li> 	27.5		</li>
         	<li> 	28			</li>
         	<li> 	28.5		</li>
         	<li> 	29			</li>
         	<li> 	29.5		</li>
         	<li> 	30			</li>
         	<li> 	30.5		</li>
         </ul>";
}

if (  strpos(  $szPostTitle,
               'hildren'
            )  !==   false
   )
//	Girls Shoe Sizes
{  echo  "<h2> Girls Shoe Sizes   </h2>";  
   echo  "<ul>
         	<li>	English	</li>
         	<li> 	11			</li>
         	<li> 	11.5		</li>
         	<li> 	12			</li>
         	<li> 	12.5		</li>
         	<li> 	13			</li>
         	<li> 	13.5		</li>
         	<li> 	14			</li>
         	<li> 	14.5		</li>
         	<li> 	15			</li>
         	<li> 	15.5		</li>
         </ul>
         
         <ul>
         	<li>	European	</li>
         	<li>	29			</li>
         	<li> 	30			</li>
         	<li> 	30.5		</li>
         	<li> 	31			</li>
         	<li> 	31.5		</li>
         	<li> 	32.2		</li>
         	<li> 	33			</li>
         	<li> 	33.5		</li>
         	<li> 	34			</li>
         	<li> 	35			</li>
         </ul>
         
         <ul>
         	<li>	American	</li>
         	<li> 	11.5		</li>
         	<li> 	12			</li>
         	<li> 	13.5		</li>
         	<li> 	13			</li>
         	<li> 	13.5		</li>
         	<li> 	14			</li>
         	<li> 	14.5		</li>
         	<li> 	15			</li>
         	<li> 	15.5		</li>
         	<li> 	16			</li>
         </ul>
         
         <ul>
         	<li>	Japanese	</li>
         	<li> 	17.5		</li>
         	<li> 	18			</li>
         	<li> 	18.5		</li>
         	<li> 	19			</li>
         	<li> 	19.5		</li>
         	<li>	20 		</li>
         	<li>	20.5		</li>
         	<li> 	21			</li>
         	<li> 	21.5		</li>
         	<li> 	22			</li>
         </ul>";
         
// Boys Shoe Sizes
   echo     "<h2> Boys Shoe Sizes   </h2>";
   echo     "<ul  class	=	'shoe-size-chart'	>
            	<li>	English	</li>
            	<li> 	11			</li>
            	<li> 	11.5		</li>
            	<li>	12			</li>
            	<li> 	12.5		</li>
            	<li> 	13			</li>
            	<li> 	13.5		</li>
            	<li> 	14			</li>
            	<li> 	14.5		</li>
            	<li> 	15			</li>
            	<li> 	15.5		</li>
            	<li> 	16			</li>
            	<li> 	16.5		</li>
            </ul>
            
            <ul>
            	<li>	European	</li>
            	<li> 	29			</li>
            	<li> 	29.7		</li>
            	<li> 	30.5		</li>
            	<li> 	31			</li>
            	<li> 	31.5		</li>
            	<li>	33			</li>
            	<li>	33.5		</li>
            	<li> 	34			</li>
            	<li> 	34.7		</li>
            	<li> 	35			</li>
            	<li> 	35.5		</li>
            	<li> 	36			</li>
            </ul>
            
            <ul>
            	<li>	American	</li>
            	<li> 	11.5		</li>
            	<li> 	12			</li> 
            	<li>	12.5		</li>
            	<li> 	13			</li>
            	<li> 	13.5		</li>
            	<li> 	14			</li>
            	<li> 	14.5		</li>
            	<li> 	15			</li>
            	<li> 	15.5		</li>
            	<li> 	16			</li>
            	<li> 	16.5		</li>
            	<li> 	17			</li>
            </ul>
            
            <ul>
            	<li>	Japanese	</li>
            	<li> 	16.5		</li>
            	<li> 	17			</li>
            	<li> 	17.5		</li>
            	<li> 	18			</li>
            	<li> 	18.5		</li>
            	<li> 	19			</li>
            	<li> 	19.5		</li>
            	<li> 	20			</li>
            	<li> 	20.5		</li>
            	<li> 	21			</li>
            	<li> 	21.5		</li>
            	<li> 	22			</li>
            </ul>";
}
?>

</div>