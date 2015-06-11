<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesSeeder extends Seeder {

	/**
	 * Add roles and permissions to the database
	 *
	 * @return void
	 */
	public function run()
	{
		$permissions = array(
			array( 'name' => 'admin' ),
			array( 'name' => 'edit_settings' ),
			array( 'name' => 'add_users' ),
			array( 'name' => 'edit_users' ),
			array( 'name' => 'delete_users' ),
			array( 'name' => 'assign_roles' ),
			array( 'name' => 'add_tickets' ),
			array( 'name' => 'edit_tickets' ),
			array( 'name' => 'close_tickets' ),
			array( 'name' => 'delete_tickets' ),
			array( 'name' => 'add_comment' ),
			array( 'name' => 'add_internal_comment' ),
			array( 'name' => 'edit_comment' ),
			array( 'name' => 'delete_comment' ),
		);

		$roles = array(
			array(
				'name' 			=> 'admin',
				'display_name' 	=> 'Admin',
				'description' 	=> 'User able to edit and manage entire website',
				'permissions'	=> array(
					'admin',
					'edit_settings',
					'view_users',
					'add_users',
					'edit_users',
					'delete_users',
					'assign_roles',
					'add_tickets',
					'edit_tickets',
					'close_tickets',
					'delete_tickets',
					'add_comment',
					'add_internal_comment',
					'edit_comment',
					'delete_comment'
				)
			),
			array(
				'name' 			=> 'manager',
				'display_name' 	=> 'Account manager',
				'description' 	=> 'User able to create and manage users and tickets',
				'permissions'	=> array(
					'add_users',
					'view_users',
					'edit_users',
					'delete_users',
					'assign_roles',
					'add_tickets',
					'edit_tickets',
					'close_tickets',
					'delete_tickets',
					'add_comment',
					'add_internal_comment',
					'edit_comment',
					'delete_comment'
				)
			),
			array(
				'name' 			=> 'user',
				'display_name' 	=> 'User',
				'description' 	=> '',
				'permissions'	=> array(
					'add_tickets',
					'edit_tickets',
					'add_comment',
					'edit_comment',
				)
			)
		);

		//Add permissions
		$p = new App\Permission;
		foreach( $permissions as $permission ){
			$p->create($permission); //TODO tur into firstOrCreate
		}
		$this->command->info('User permissions seeded');

		//Add Roles
		foreach( $roles as $role ){
			$r = new App\Role;

			//Create the role
			$r->name 		 = $role['name'];
			$r->display_name = $role['display_name'];
			$r->description  = $role['description'];
			$r->save();
			//TODO change into FirstOrCreate

			//Get roles permissions
			$permissions = $p->whereIn('name', $role['permissions'])->get(['id'])->toArray();

			//Add the permissions
			foreach( $permissions as $permission ){
				$r->perms()->attach($permission['id']);
			}
		}
		$this->command->info('User roles seeded');

	}

}
