<?php
namespace MathPHP\Tests\Probability\Distribution\Continuous;

use MathPHP\Probability\Distribution\Continuous\LogNormal;

class LogNormalTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testCase     pdf
     * @dataProvider dataProviderForPdf
     * @param        float $x
     * @param        float $μ
     * @param        float $σ
     * @param        float $expected_pdf
     */
    public function testPdf(float $x, float $μ, float $σ, float $expected_pdf)
    {
        // Given
        $log_normal = new LogNormal($μ, $σ);

        // When
        $pdf = $log_normal->pdf($x);

        // Then
        $this->assertEquals($expected_pdf, $pdf, '', 0.000001);
    }

    /**
     * @return array [x, μ, σ, pdf]
     * Generated with R (stats) dlnorm(q, meanlog sdlog)
     */
    public function dataProviderForPdf(): array
    {
        return [
            [4.3, 6, 2, 0.003522012],
            [4.3, 6, 1, 3.082892e-06],
            [4.3, 1, 1, 0.08351597],
            [1, 6, 2, 0.002215924],
            [2, 6, 2, 0.002951125],
            [2, 3, 2, 0.0512813],

            [0.1, -2, 1, 3.810909],
            [1, -2, 1, 0.05399097],
            [2, -2, 1, 0.005307647],
            [5, -2, 1, 0.0001182869],
        ];
    }

    /**
     * @dataProvider dataProviderForCdf
     * @param        float $x
     * @param        float $μ
     * @param        float $σ
     * @param        float $expected_pdf
     */
    public function testCdf(float $x, float $μ, float $σ, float $expected_pdf)
    {
        // Given
        $log_normal = new LogNormal($μ, $σ);

        // When
        $cdf = $log_normal->cdf($x);

        // Then
        $this->assertEquals($expected_pdf, $cdf, '', 0.000001);
    }

    /**
     * @return array [x, μ, σ, cdf]
     * Generated with R (stats) plnorm(q, meanlog sdlog)
     */
    public function dataProviderForCdf(): array
    {
        return [
            [4.3, 6, 2, 0.0115828],
            [4.3, 6, 1, 2.794294e-06],
            [4.3, 1, 1, 0.6767447],
            [1, 6, 2, 0.001349898],
            [2, 6, 2, 0.003983957],
            [2, 3, 2, 0.1243677],

            [0.1, -2, 1, 0.381103],
            [1, -2, 1, 0.9772499],
            [2, -2, 1, 0.9964609],
            [5, -2, 1, 0.9998466],
        ];
    }

    /**
     * @dataProvider dataProviderForMean
     * @param        float $μ
     * @param        float $σ
     * @param        float $expected_mean
     */
    public function testMean(float $μ, float $σ, float $expected_mean)
    {
        // Given
        $log_normal = new LogNormal($μ, $σ);

        // When
        $mean = $log_normal->mean();

        // Then
        $this->assertEquals($expected_mean, $mean, '', 0.000001);
    }

    /**
     * @return array
     */
    public function dataProviderForMean(): array
    {
        return [
            [1, 1, 4.48168907034],
            [2, 2, 54.5981500331],
            [1.3, 1.6, 13.1971381597],
            [2.6, 3.16, 1983.86055382],
        ];
    }

    /**
     * @dataProvider dataProviderForMedian
     * @param        float $μ
     * @param        float $σ
     * @param        float $expected_median
     */
    public function testMedian(float $μ, float $σ, float $expected_median)
    {
        // Given
        $log_normal = new LogNormal($μ, $σ);

        // When
        $median = $log_normal->median();

        // Then
        $this->assertEquals($expected_median, $median, '', 0.000001);
    }

    /**
     * @return array
     */
    public function dataProviderForMedian(): array
    {
        return [
            [1, 1, 2.718281828459045],
            [2, 2, 7.38905609893065],
            [1.3, 1.6, 3.669296667619244],
            [2.6, 3.16, 13.46373803500169],
        ];
    }

    /**
     * @testCase     inverse
     * @dataProvider dataProviderForInverse
     * @param        float $p
     * @param        float $μ
     * @param        float $σ
     * @param        float $expected_inverse
     */
    public function testInverse(float $p, float $μ, float $σ, float $expected_inverse)
    {
        // Given
        $log_normal = new LogNormal($μ, $σ);

        // When
        $inverse = $log_normal->inverse($p);

        // Then
        $this->assertEquals($expected_inverse, $inverse, '', 0.001);
    }

    /**
     * @return array [p, μ, σ, inverse]
     * Generated with R (stats) qlnorm(p, meanlog, sdlog)
     */
    public function dataProviderForInverse(): array
    {
        return [
            [0, -1, 1, 0],
            [0.1, -1, 1, 0.1021256],
            [0.2, -1, 1, 0.1585602],
            [0.3, -1, 1, 0.2177516],
            [0.5, -1, 1, 0.3678794],
            [0.7, -1, 1, 0.6215124],
            [0.9, -1, 1, 1.325184],
            [1, -1, 1, \INF],

            [0, 1, 1, 0],
            [0.1, 1, 1, 0.754612],
            [0.3, 1, 1, 1.608978],
            [0.5, 1, 1, 2.718282],
            [0.7, 1, 1, 4.59239],
            [0.9, 1, 1, 9.791861],
            [1, 1, 1, \INF],

            [0, 2, 3,0 ],
            [0.1, 2, 3, 0.1580799],
            [0.3, 2, 3, 1.532344],
            [0.5, 2, 3, 7.389056],
            [0.7, 2, 3, 35.63048],
            [0.9, 2, 3, 345.3833],
            [1, 2, 3, \INF],

            [0, 5, 2, 0],
            [0.1, 5, 2, 11.43749],
            [0.3, 5, 2, 51.99767],
            [0.5, 5, 2, 148.4132],
            [0.7, 5, 2, 423.6048],
            [0.8, 5, 2, 798.9053],
            [1, 5, 2, \INF],
        ];
    }

    /**
     * @testCase     inverse of CDF is original x
     * @dataProvider dataProviderForCdf
     * @param        float $x
     * @param        float $μ
     * @param        float $σ
     */
    public function testInverseOfCdf(float $x, float $μ, float $σ)
    {
        // Given
        $log_normal = new LogNormal($μ, $σ);
        $cdf        = $log_normal->cdf($x);

        // When
        $inverse_of_cdf = $log_normal->inverse($cdf);

        // Then
        $this->assertEquals($x, $inverse_of_cdf, '', 0.001);
    }

    /**
     * @testCase rand
     */
    public function testRand()
    {
        foreach (range(-3, 3) as $μ) {
            foreach (range(1, 3) as $σ) {
                // Given
                $log_normal = new LogNormal($μ, $σ);

                // When
                $random = $log_normal->rand();

                // Then
                $this->assertTrue(is_numeric($random));
            }
        }
    }
}