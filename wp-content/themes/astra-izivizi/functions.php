<?php
/**
 * izivizi Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package izivizi
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_IZIVIZI_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'izivizi-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_IZIVIZI_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



// Enqueue Chart.js and GSAP
function enqueue_custom_scripts() {
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true);
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Shortcode to display the chart
function display_seo_traffic_chart() {
    ob_start();
    ?>
    <canvas id="myChart" width="600" height="400"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myChart').getContext('2d');
            const data = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Website Traffic',
                    data: [10, 20, 30, 50, 80, 130, 210],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false,
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    animation: {
                        duration: 0
                    },
                    plugins: {
                        streaming: false
                    }
                },
                plugins: [{
                    id: 'progressiveLineDrawing',
                    afterDatasetDraw: (chart, args, options) => {
                        const { ctx, chartArea: { left, right, top, bottom, width, height }, scales: { x, y } } = chart;
                        const dataset = chart.data.datasets[0];
                        const meta = chart.getDatasetMeta(0);
                        const points = meta.data;

                        let previousPoint = points[0];
                        ctx.save();
                        ctx.beginPath();
                        ctx.moveTo(previousPoint.x, previousPoint.y);

                        points.forEach((point, index) => {
                            if (index === 0) return;
                            const progress = gsap.utils.clamp(0, 1, (chart.animations[0].currentStep / chart.animations[0].numSteps) - (index - 1));
                            ctx.lineTo(
                                previousPoint.x + (point.x - previousPoint.x) * progress,
                                previousPoint.y + (point.y - previousPoint.y) * progress
                            );
                            if (progress < 1) {
                                ctx.stroke();
                                ctx.beginPath();
                                ctx.moveTo(
                                    previousPoint.x + (point.x - previousPoint.x) * progress,
                                    previousPoint.y + (point.y - previousPoint.y) * progress
                                );
                                return;
                            }
                            previousPoint = point;
                        });
                        ctx.lineTo(points[points.length - 1].x, points[points.length - 1].y);
                        ctx.stroke();
                        ctx.restore();
                    }
                }]
            };

            const myChart = new Chart(ctx, config);

            gsap.fromTo(myChart, {
                animations: [{
                    currentStep: 0,
                    numSteps: 100
                }]
            }, {
                animations: [{
                    currentStep: 100,
                    numSteps: 100
                }],
                duration: 3,
                ease: "power1.inOut",
                onUpdate: () => myChart.update()
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('seo_traffic_chart', 'display_seo_traffic_chart');