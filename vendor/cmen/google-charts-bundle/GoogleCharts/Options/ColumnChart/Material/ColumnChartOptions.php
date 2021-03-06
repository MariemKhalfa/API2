<?php

namespace CMEN\GoogleChartsBundle\GoogleCharts\Options\ColumnChart\Material;

use CMEN\GoogleChartsBundle\GoogleCharts\Options\BarsTrait;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\Material\Chart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\Material\MaterialTrait;

/**
 * Class ColumnChartOptions.
 *
 * @author Christophe Meneses
 */
class ColumnChartOptions extends \CMEN\GoogleChartsBundle\GoogleCharts\Options\ColumnChart\ColumnChartOptions
{
    use MaterialTrait;

    use BarsTrait;

    /**
     * ColumnChartOptions constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->chart = new Chart();
    }
}
