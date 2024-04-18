<?php
function homepage_scroll_animation()
{
?>
	<script>
		document.addEventListener('DOMContentLoaded', (e) => {
			e.preventDefault();
			if (window.innerWidth > 870) {
				// img_shadow on scroll
				let boxes = gsap.utils.toArray('.img_shadow');
				boxes.forEach((box, index) => {
					// let distance = index % 2 === 0 ? '-100%' : '100%';
					let rotationStart = index % 2 === 0 ? '45' : '-45';
					let rotation = index % 2 === 0 ? '-45' : '45';
					gsap.fromTo(box, {
						rotation: rotationStart,
						// x: distance,
						// yPercent: 50,
						// opacity: 0,
					}, {
						rotation: rotation,
						// x: 0,
						// yPercent: 0,
						duration: 9,
						opacity: 1,
						ease: 'expo.out',
						scrollTrigger: {
							trigger: box,
							start: '-=250px 60%',
							// start: '-=200px center',
							end: 'bottom 20%',
							// markers: true,
						}
					})
				})
				// pc slight parallaxe 
				let imgs = gsap.utils.toArray('.feat_container > img');
				imgs.forEach((img, index) => {
					gsap.to(img, {
						y: "-5%",
						ease: "none",
						scrollTrigger: {
							trigger: img,
							start: "top center",
							scrub: 1,
							// markers: true,
						},
					})
				});
			}
		})
	</script>
<?php
}
add_action('wp_head', 'homepage_scroll_animation');
