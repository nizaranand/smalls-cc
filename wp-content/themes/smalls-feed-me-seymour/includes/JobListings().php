<?php
function	JobListings()
{	register_post_type(	'job',
/*	jonathan@smalls.cc	2012 November 6
 *	Job posts will be sorted into performance, and professional types with
 *	emphasis on the skills used to quickly generate a relevant resume for
 *	a given application.
 */
				array(
		'label'		=>	'Jobs',
		'labels'	=>	array(	'name'		=>	'Job Listings',
						'singular_name'	=>	'Job',
						'add_new'	=>	'Add New Entry',
						'all_items'	=>	'Work History'
						),
		'public'	=>	true
					)
				);

	register_taxonomy(	'type',
/*	jonathan@smalls.cc	2012 November 6
 *	I intend to use this field to make a distinction between professional,
 *	performance jobs. I guess that the easiest way is to be specific within
 *	that dichotomy ( web developer, system administrator, dancer, actor ).
 */
				'job',
				array(
		'label'		=>	'Type',
		'labels'	=>	array(	'name'		=>	'Types',
						'singular_name'	=>	'Type',
						'add_new'	=>	'Add New Type',
						'all_items'	=>	'All Job Types'
						),
		'public'	=>	true
					)
				);

	register_taxonomy(	'role',
/*	jonathan@smalls.cc	2012 November 6
 *	Noting my role in the job is important.
 */
				'job',
				array(
		'label'		=>	'Roles',
		'labels'	=>	array(	'name'		=>	'Roles',
						'singular_name'	=>	'Role',
						'add_new'	=>	'Add New Role',
						'all_items'	=>	'All Roles'
						),
		'public'	=>	true
					)
				);

	register_taxonomy(	'task',
/*	jonathan@smalls.cc	2012 November 6
 *	These fields will note the tasks, and responsibilies associated with a given
 *	job. It is not really relevant for performance jobs, or is it? We shall see.
 */
				'job',
				array(
		'label'		=>	'Roles',
		'labels'	=>	array(	'name'		=>	'Tasks',
						'singular_name'	=>	'Task',
						'add_new'	=>	'Add New Task',
						'all_items'	=>	'All Tasks'
						),
		'public'	=>	true
					)
				);

	register_taxonomy(	'date',
/*	jonathan@smalls.cc	2012 November 7
 *	For jobs with a duration like professional work, or theatre runs I want to
 *	reference when it happened.
 */
				'job',
				array(
		'label'		=>	'Date',
		'labels'	=>	array(	'name'		=>	'Dates',
						'singular_name'	=>	'Date',
						'add_new'	=>	'Add New Date'
						),
		'public'	=>	true
					)
				);
}

JobListings();
?>
