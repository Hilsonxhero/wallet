<?php

namespace Modules\User\Repository\Eloquent;

use Modules\User\App\Models\User;
use Modules\Wallet\App\Models\Wallet;
use Modules\Wallet\App\Models\UserWallet;
use Modules\User\Repository\Contracts\UserRepository;

class UserRepositoryEloquent implements UserRepository
{

    /**
     * Retrieve all users ordered by the creation date in descending order.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of all User models.
     */
    public function get()
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    /**
     * Create a new user with the given data.
     *
     * @param array $data Associative array of user data to create the user.
     * @return User The newly created User model.
     */
    public function create($data)
    {
        $item = User::query()->create($data);
        return $item;
    }

    /**
     * Update an existing user identified by the given ID with the provided data.
     *
     * @param int $id The ID of the user to update.
     * @param array $data Associative array of user data to update.
     * @return User The updated User model.
     */
    public function update($id, $data)
    {
        $item = $this->find($id);
        $item->update($data);
        return $item;
    }

    /**
     * Retrieve a user by its ID.
     *
     * @param int $id The ID of the user to retrieve.
     * @return User|null The User model if found, null otherwise.
     */
    public function show($id)
    {
        $item = $this->find($id);
        return $item;
    }

    /**
     * Find a user by a specific field and its value.
     *
     * @param mixed $id The value of the field to search by.
     * @param string $field The field to search for. Defaults to "id".
     * @return User|null The User model if found, null otherwise.
     */
    public function find($id, $field = "id")
    {
        $item = User::query()->where($field, $id)->first();
        return $item;
    }

    /**
     * Delete a user identified by the given ID.
     *
     * @param int $id The ID of the user to delete.
     * @return void
     */
    public function delete($id)
    {
        $item = $this->find($id);
        if ($item) {
            $item->delete();
        }
    }

    /**
     * Check if the specified wallet exists for the given user.
     *
     * @param User $user The user to check.
     * @param Wallet $wallet The wallet to check for.
     * @return UserWallet UserWallet object if the wallet exists for the user, false otherwise.
     */
    public function walletExistsForUser(User $user, Wallet $wallet): ?UserWallet
    {
        return $user->wallets()->where('wallet_id', $wallet->id)->first();
    }


    /**
     * Decrement the balance of the specified wallet.
     *
     * @param UserWallet $wallet The wallet whose balance is to be decremented.
     * @param int $amount The amount to decrement from the wallet balance.
     * @return bool True if the balance was successfully decremented, false otherwise.
     */
    public function decrementWalletBalance(UserWallet $wallet, int $amount): bool
    {
        $wallet->decrement('balance', $amount);
        return true;
    }

    /**
     * Increment the balance of the specified wallet.
     *
     * @param UserWallet $wallet The wallet whose balance is to be incremented.
     * @param int $amount The amount to increment the wallet balance by.
     * @return bool True if the balance was successfully incremented, false otherwise.
     */
    public function incrementWalletBalance(UserWallet $wallet, int $amount): bool
    {
        // Increment the balance by the specified amount
        $wallet->increment('balance', $amount);

        // Return true to indicate the operation was successful
        return true;
    }


    /**
     * Check if the requested amount is less than or equal to the user's wallet balance.
     *
     * @param UserWallet $wallet The wallet whose balance is to be incremented.
     * @param int $amount The amount to check against the wallet balance.
     * @return bool True if the amount is less than or equal to the wallet balance, false otherwise.
     */
    public function checkValidWithdrawAmount(UserWallet $wallet, int $amount): bool
    {
        if ($wallet->balance > $amount) {
            return true;
        }
        return false;
    }
}
