# Multicurrency Bank
A package of classes for working with the multicurrency bank without di and tests

## Sample code
```
<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Bank\MoneyFactory;
use App\Bank\RatesConfigFactory;
use App\BankFactory;
use App\Enums\CurrencyTypes;

// Create rate config object
$ratesConfig = RatesConfigFactory::create([
    CurrencyTypes::USD->value => [
        CurrencyTypes::EUR->value => 1,
        CurrencyTypes::RUB->value => 80
    ],
    CurrencyTypes::EUR->value => [
        CurrencyTypes::USD->value => 1,
        CurrencyTypes::RUB->value => 80
    ],
    CurrencyTypes::RUB->value => [
        CurrencyTypes::EUR->value => 0.0125,
        CurrencyTypes::USD->value => 0.0125
    ],
]);

// Create Bank
$bank = BankFactory::create($ratesConfig, CurrencyTypes::USD);

// Create account
$account = $bank->createAccount();

// Deposit money
$account->deposit(MoneyFactory::create(CurrencyTypes::USD, 50));

// Deposit currency account and money
$account->addCurrencyAccount(CurrencyTypes::RUB);

// Deposit money
$account->deposit(MoneyFactory::create(CurrencyTypes::RUB, 160));

// Convert and withdraw money
$account->withdraw(
    $bank->convertMoney(MoneyFactory::create(CurrencyTypes::RUB, 800), CurrencyTypes::USD)
);

// Set default currency code
$account->setDefaultCurrencyCode(CurrencyTypes::RUB);

// Set new currency rate
$bank->setCurrencyRate(CurrencyTypes::USD, CurrencyTypes::RUB, 70);

// Remove currency account
$account->removeCurrencyAccount(CurrencyTypes::USD);

print_r($account->getBanalce());
// App\Bank\Money Object
// (
//     [amount:App\Bank\Money:private] => 2960
//     [currencyCode:App\Bank\Money:private] => App\Enums\CurrencyTypes Enum:string
//         (
//             [name] => RUB
//             [value] => RUB
//         )
// 
// )

print_r($account->getBanalce(CurrencyTypes::from('USD')));
// App\Bank\Money Object
// (
//     [amount:App\Bank\Money:private] => 42.285714285714
//     [currencyCode:App\Bank\Money:private] => App\Enums\CurrencyTypes Enum:string
//         (
//             [name] => USD
//             [value] => USD
//         )
// 
// )
```
