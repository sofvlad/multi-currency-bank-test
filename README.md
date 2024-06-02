# Multicurrency Bank
A package of classes for working with the multicurrency bank without di and tests

## Sample code
```
<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Bank\MoneyFactory;
use App\Bank\RatesConfigFactory;
use App\BankFactory;

// Create rate config object
$ratesConfig = RatesConfigFactory::create([
    'USD' => [
        'EUR' => 1,
        'RUB' => 80
    ],
    'EUR' => [
        'USD' => 1,
        'RUB' => 80
    ],
    'RUB' => [
        'EUR' => 0.0125,
        'USD' => 0.0125
    ],
]);

// Create Bank
$bank = BankFactory::create($ratesConfig, 'USD');

// Create account
$account = $bank->createAccount();

// Deposit money
$account->deposit(MoneyFactory::create('USD', 50));

// Deposit currency account and money
$account->addCurrencyAccount('RUB');

// Deposit money
$account->deposit(MoneyFactory::create('RUB', 160));

// Convert and withdraw money
$account->withdraw(
    $bank->convertMoney(MoneyFactory::create('RUB', 800), 'USD')
);

// Set default currency code
$account->setDefaultCurrencyCode('RUB');

// Set new currency rate
$bank->setCurrencyRate('USD', 'RUB', 70);

// Remove currency account
$account->removeCurrencyAccount('USD');

print_r($account->getBanalce());
// App\Bank\Money Object
// (
//     [amount:App\Bank\Money:private] => 2960
//     [currencyCode:App\Bank\Money:private] => RUB
// )
```
