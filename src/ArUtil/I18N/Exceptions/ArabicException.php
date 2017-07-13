<?php

namespace ArUtil\Exceptions;
/**
 * Arabic Exception class defined by extending the built-in Exception class.
 *
 * @category  I18N
 * @package   I18N_Arabic
 * @author    Khaled Al-Shamaa <khaled@ar-php.org>
 * @copyright 2006-2013 Khaled Al-Shamaa
 *
 * @license   LGPL <http://www.gnu.org/licenses/lgpl.txt>
 * @link      http://www.ar-php.org
 */
class ArabicException extends \Exception
{
    /**
     * Make sure everything is assigned properly
     *
     * @param string $message Exception message
     * @param int    $code    User defined exception code
     */
    public function __construct($message, $code=0)
    {
        parent::__construct($message, $code);
    }
}