<?php

namespace Tests\Leos\Domain\Withdrawal\Model;

use Leos\Domain\Wallet\Model\Wallet;
use Leos\Domain\Money\ValueObject\Money;
use Leos\Domain\Money\ValueObject\Currency;
use Leos\Domain\Withdrawal\Model\Withdrawal;
use Leos\Domain\Withdrawal\Model\RollbackWithdrawal;
use Leos\Domain\Transaction\Model\AbstractTransaction;

/**
 * Class RollbackWithdrawalTest
 *
 * @package Tests\Leos\Domain\Withdrawal\Model
 */
class RollbackWithdrawalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group unit
     */
    public function testConstruct()
    {
        $wallet = new Wallet();

        $wallet->addRealMoney(new Money(50 ,$currency = new Currency('EUR', 1)));

        $transaction = new RollbackWithdrawal(
            new Withdrawal($wallet, new Money(50, $currency))
        );

        self::assertInstanceOf(AbstractTransaction::class, $transaction);
        self::assertEquals(5000, $transaction->wallet()->real()->amount());
    }
}