<?php

namespace Arekaev\TbankPayment\Enums;

class Taxation extends Enum
{
    /**
     * Общая
     */
    public const OSN = 'osn';

    /**
     * Упрощенная (доходы)
     */
    public const USN_INCOME = 'usn_income';

    /**
     * Упрощенная (доходы минус расходы)
     */
    public const USN_INCOME_OUTCOME = 'usn_income_outcome';

    /**
     * Патентная
     */
    public const PATENT = 'patent';

    /**
     * Единый налог на вмененный доход
     */
    public const ENVD = 'envd';

    /**
     *  Единый сельскохозяйственный налог
     */
    public const ESN = 'esn';

}