<?php

namespace Modules\User\Repository\Contracts;

use Modules\User\App\Models\User;
use Modules\Wallet\App\Models\UserWallet;
use Modules\Wallet\App\Models\Wallet;

interface UserRepository
{
    public function get();
    public function create($data);
    public function update($id, $data);
    public function find($id, $field = "id");
    public function delete($id);
    public function walletExistsForUser(User $user, Wallet $wallet): ?UserWallet;
    public function decrementWalletBalance(UserWallet $wallet, int $amount): bool;
    public function incrementWalletBalance(UserWallet $wallet, int $amount): bool;
    public function checkValidWithdrawAmount(UserWallet $wallet, int $amount): bool;
}
