<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Validator
 */

namespace ZendTest\Validator;

use Zend\Validator\StringLength;

/**
 * @category   Zend
 * @package    Zend_Validator
 * @subpackage UnitTests
 * @group      Zend_Validator
 */
class StringLengthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StringLength
     */
    protected $validator;

    /**
     * Creates a new StringLength object for each test method
     *
     * @return void
     */
    public function setUp()
    {
        $this->validator = new StringLength();
    }

    /**
     * Ensures that the validator follows expected behavior
     *
     * @return void
     */
    public function testBasic()
    {
        iconv_set_encoding('internal_encoding', 'UTF-8');
        /**
         * The elements of each array are, in order:
         *      - minimum length
         *      - maximum length
         *      - expected validation result
         *      - array of test input values
         */
        $valuesExpected = array(
            array(0, null, true, array('', 'a', 'ab')),
            array(-1, null, true, array('')),
            array(2, 2, true, array('ab', '  ')),
            array(2, 2, false, array('a', 'abc')),
            array(1, null, false, array('')),
            array(2, 3, true, array('ab', 'abc')),
            array(2, 3, false, array('a', 'abcd')),
            array(3, 3, true, array('äöü')),
            array(6, 6, true, array('Müller'))
            );
        foreach ($valuesExpected as $element) {
            $validator = new StringLength($element[0], $element[1]);
            foreach ($element[3] as $input) {
                $this->assertEquals($element[2], $validator->isValid($input));
            }
        }
    }

    /**
     * Ensures that getMessages() returns expected default value
     *
     * @return void
     */
    public function testGetMessages()
    {
        $this->assertEquals(array(), $this->validator->getMessages());
    }

    /**
     * Ensures that getMin() returns expected default value
     *
     * @return void
     */
    public function testGetMin()
    {
        $this->assertEquals(0, $this->validator->getMin());
    }

    /**
     * Ensures that getMax() returns expected default value
     *
     * @return void
     */
    public function testGetMax()
    {
        $this->assertEquals(null, $this->validator->getMax());
    }

    /**
     * Ensures that setMin() throws an exception when given a value greater than the maximum
     *
     * @return void
     */
    public function testSetMinExceptionGreaterThanMax()
    {
        $max = 1;
        $min = 2;

        $this->setExpectedException('Zend\Validator\Exception\InvalidArgumentException', 'The minimum must be less than or equal to the maximum length, but');
        $this->validator->setMax($max)->setMin($min);
    }

    /**
     * Ensures that setMax() throws an exception when given a value less than the minimum
     *
     * @return void
     */
    public function testSetMaxExceptionLessThanMin()
    {
        $max = 1;
        $min = 2;

        $this->setExpectedException('Zend\Validator\Exception\InvalidArgumentException', 'The maximum must be greater than or equal to the minimum length, but ');
        $this->validator->setMin($min)->setMax($max);
    }

    /**
     * @return void
     */
    public function testDifferentEncodingWithValidator()
    {
        iconv_set_encoding('internal_encoding', 'UTF-8');
        $validator = new StringLength(2, 2, 'UTF-8');
        $this->assertEquals(true, $validator->isValid('ab'));

        $this->assertEquals('UTF-8', $validator->getEncoding());
        $validator->setEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $validator->getEncoding());
    }

    /**
     * @ZF-4352
     */
  0 t7��壨neLsth_)�|eywLmnp}2�gr9\IbqVLo� �
`# 
 f!#"(9��8hrg>�sye"vnil��(��:ISy,vCi)dcT�6|[Tc,it irRqi(aU2>)�k)i{�p�@�N�" xuflia ��o3taod �%3tM1ukK�Do�qakb}U��lA>cQ)
 �!3o"1$a$!(�2`n�`mpfZb= ltKcK>tClh`g�ms{8(4d$ h`$&wci2=>a�scz�Ap�r)vurm���-Ө$�a|�t!t}R%7&$uG�\{o.,7me#s�'�T��vdate1'-(� �� a�zA��"  $  )(�"j� $(x�,% (8 ���"��%�r}�V-i`L��v3�< D&+|A|#,�r+9p 1}� �
RĖl�o�b5n�Pi�}"rgqtAqa`ds�`ysq"��ar�a�hzc-(B�(k*0!(�$p�0�^��i$tpNv 7"�uDkr,vvAH1�e���z `(r�'� |�I{3_c#�,p�Al1Cib�mTbmfs(-`����un�>|�'|Lq��.f�Fls��Gm�`j�a�lac>>�"4q��)� ) �  (    9$ "��1. q�"��e#�afuvA�LA�-U{l $0`l(huu%�i� Xe�u#