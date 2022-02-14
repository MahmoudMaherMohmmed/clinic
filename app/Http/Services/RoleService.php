<?php


namespace App\Http\Services;

use App\Http\Repository\RoleRepository;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * __construct
     *
     * @param  RoleRepository $roleRepository
     * @return void
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository  = $roleRepository;
    }
    /**
     * handle function that make update for role
     * @param array $request
     * @return Role
     */
    public function handle($request, $roleId = null)
    {
        $role = $this->roleRepository;

        if ($roleId) {
            $role = $this->roleRepository->find($roleId);
        }

        $role->fill($request);

        $role->save();

        return $role;
    }
}
