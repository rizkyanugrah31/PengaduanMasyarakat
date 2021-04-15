<?php
    namespace App\Observers;

    use Illuminate\Support\Facades\Auth;
    use App\User;
    use App\Role;

    class UserActionsObserver
    {
        public function saved($model)
        {
            if ($model->wasRecentlyCreated == true) {
                // Data was just created
                $action = 'created_at';
            } else {
                // Data was updated
                $action = 'updated_at';
            }
            if (Auth::check()) {
                Role::create([
                    'id'      => Auth::user()->id
                ]);
            }
        }

        public function deleting($model)
        {
            if (Auth::check()) {
                Role::create([
                    'id'      => Auth::user()->id
                ]);
            }
        }
    }
?>
