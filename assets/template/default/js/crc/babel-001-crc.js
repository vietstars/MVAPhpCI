var Mission1 = React.createClass({
	render(){
	return (<div className="content">
			<h3 className="hl-title">FUTURE DRIVEN<small></small></h3>
			<div className="mission-description">The CRC was born with the mission to become MV’s R&D arm, designing and developing the marque’s high-performing motorcycles. It currently employs around 40 people and is entirely dedicated to the creation of ever more advanced, aspirational and best-in-class motorcycles.</div>
		</div>);
	}
});
var Mission2 = React.createClass({
	render(){
	return (<div className="content">
				<h3 className="hl-title">REPARTO VEICOLI SPECIALI<small></small></h3>
				<div className="mission-description">Born within our CRC, the best reviews to instil passion, design and technology in a dynamic object.</div>
			</div>);
	}
});
var Mission3 = React.createClass({
	render(){
	return (<div className="content">
				<h3 className="hl-title">ONE OF A KIND EDITIONS<small></small></h3>
				<div className="mission-description">Unique creations in the name of innovation. One-offs are motorcycles that adopt personalised design and technology. These bikes are made to move, in every sense, to be stared at and to simply be unique. They are MV’s philosophy transposed into a material object.</div>
			</div>);
	}
});
var Mission4 = React.createClass({
	render(){
	return (<div className="container detail-bar">
		<div className="tab-content" id="detail-tabContent">
			<div className="tab-pane fade show active" id="detail-item-1" role="tabpanel" aria-labelledby="detail-home-tab">
			  	<div className="row">
			  		<div className="detail-content col-md-5 align-self-center">
						<h2>F4Z SHEER BEAUTY</h2>
						<span>A project commissioned by a Japanese client from designers Zagato. Their task was to turn the iconic F4 into the first atelier superbike. The body work is reminiscent of the racing fairing of the 1950’s with the timeless elegance of Zagato.</span>
			  		</div>
					<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/mva-crc_f4z-landscape-6.jpg)'}}></div>
			  	</div>
			</div>
		</div>
		<ul className="detail-nav nav nav-pills" id="detail-tab" role="tablist">
		  <li className="nav-item">
		    <a className="nav-link active" id="detail-home-tab" data-toggle="pill" href="#detail-item-1" role="tab" aria-controls="detail-home" aria-selected="true">
				F4Z
		    </a>
		  </li>
		</ul>
	</div>);
	}
});
var Mission5 = React.createClass({
	render(){
	return (<div className="content">
				<h3 className="hl-title">CUSTOM BIKES<small></small></h3>
				<div className="mission-description">Hand-built to the specifications of individual clients, these bikes represent the pinnacle of Motorcycle Art. High-tech, luxury accessories, designer bodyworks, gold-leaf finishes or Swarovski studded components: nothing is too much for MV engineers.</div>
			</div>);
	}
});
var Mission6 = React.createClass({
	render(){
	return (<div className="container detail-bar">
				<div className="tab-content" id="detail-tabContent">
					<div className="tab-pane fade show active" id="detail-2-item-1" role="tabpanel" aria-labelledby="detail-home-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>F4 RC BLUE</h2>
								<span>The F4 RC Blue was created for the “Beasts Beirut Events & Street Show” with the colour scheme of MV Agusta Reparto Corse with light blue accents. The bike was supplied with a titanium SC exhaust, and matching Carbon X-lite 802 helmet.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/f4-rc-blue_story-image.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-2-item-2" role="tabpanel" aria-labelledby="detail-profile-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>DRAGSTER BLACKOUT</h2>
								<span>Based on the Brutale Dragster 800, the “Dragster Blackout” is the result of the collaboration between MV Agusta and Valter Moto Components.The outcome is a traffic-stopping “Techno Café Racer” packed with high-tech, cool accessories.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/dragster-balckout_story-image-1.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-2-item-3" role="tabpanel" aria-labelledby="detail-design-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>DRAGSTER RR GOLD SHEER BEAUTY</h2>
								<span>The client wanted a gilded, shining gold effect on nearly all the machine. The base model is the Dragster 800 RR. The mirrors are studded with Swarovski crystals and the bike was supplied with two matching X-lite 802 carbon fibre helmets.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/mva-crc_f4z-landscape-0.jpg)'}}></div>
					  	</div>
					</div>
				</div>
				<ul className="detail-nav nav nav-pills" id="detail-2-tab" role="tablist">
				  <li className="nav-item">
				    <a className="nav-link active" id="detail-2-home-tab" data-toggle="pill" href="#detail-2-item-1" role="tab" aria-controls="detail-home" aria-selected="true">
						F4 RC BLUE
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-2-profile-tab" data-toggle="pill" href="#detail-2-item-2" role="tab" aria-controls="detail-profile" aria-selected="false">
						BLACKOUT
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-2-design-tab" data-toggle="pill" href="#detail-2-item-3" role="tab" aria-controls="detail-design" aria-selected="false">
						DRAGSTER RR
				    </a>
				  </li>
				</ul>
			</div>);
	}
});
var Introduce = React.createClass({
	render(){
	return (<div className="introduce-block container">			
			<h3 className="hl-title">EXPLORE MV AGUSTA<small></small></h3>
			<div className="row">
				<div className="col-md-4 eq-height">
					<div className="bg-white">
						<a href="../news">
							<div className="intro-img" style={{'background':'url(../assets/img/system/mva-news-square.jpg)'}}></div>
							<div className="intro-text">
								<h3 className="intro-title">News</h3>
								<div className="intro-description">Keep up with the latest news.</div>
							</div>
						</a>
					</div>
				</div>
				<div className="col-md-4 eq-height">
					<div className="bg-white">
						<a href="../history">
							<div className="intro-img" style={{'background':'url(../assets/img/system/mva-history-podium-square.jpg)'}}></div>
							<div className="intro-text">
								<h3 className="intro-title">history</h3>
								<div className="intro-description">Find out about the history of an exclusive brand.</div>
							</div>
						</a>
					</div>
				</div>
				<div className="col-md-4 eq-height">
					<div className="bg-white">
						<a href="../about">
							<div className="intro-img" style={{'background':'url(../assets/img/system/mva-about-us_hero-square.jpg)'}}></div>
							<div className="intro-text">
								<h3 className="intro-title">This is us</h3>
								<div className="intro-description">We do not simply build motorcycles, we craft emotions. We look at the future to build machines that are always one step ahead.</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>);
	}
});
var Imgslide1 = React.createClass({
	getInitialState(){
		return {
			slideItem: [
			{imgSrc:"../assets/img/system/mva-crc_ambient-gallery-landscape-1.jpg"},
			{imgSrc:"../assets/img/system/mva-crc_ambient-gallery-landscape-2.jpg"},
			{imgSrc:"../assets/img/system/mva-crc_ambient-gallery-landscape-3.jpg"},
			{imgSrc:"../assets/img/system/mva-crc_ambient-gallery-landscape-4.jpg"},
			{imgSrc:"../assets/img/system/mva-crc_ambient-gallery-landscape-5.jpg"},
			{imgSrc:"../assets/img/system/mva-crc_ambient-gallery-landscape-6.jpg"}
			]
		}
	},
	render(){
		return (<div className="banner-slide owl-carousel">{
			this.state.slideItem.map(function (img) {
				return (<div className="slide-item" style={{"background":'url('+img.imgSrc+')'}}>
		          	<div className="container">
		          		<div><a href={img.imgSrc} target="_blank"><img src="../assets/img/system/ic_download_light.svg" alt=""/></a><a href="javascript:;" className="shares-btn" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" data-content={"<a class='share-item text-left' href='#'><i class='fa fa-facebook fa-2x'></i></a><a class='share-item text-left' href='#'><i class='fa fa-instagram fa-2x'></i></a>"}><img src="../assets/img/system/ic_share_light.svg" alt=""/></a></div>
		          	</div>
		        </div>);
			})
		}</div>);
	}
});
var Imgslide2 = React.createClass({
	getInitialState(){
		return {
			slideItem: [
			{imgSrc:"../assets/img/system/rvs-1_crc-gallery-landscape-1.jpg"},
			{imgSrc:"../assets/img/system/rvs-1_crc-gallery-landscape-2.jpg"},
			{imgSrc:"../assets/img/system/rvs-1_crc-gallery-landscape-3.jpg"},
			{imgSrc:"../assets/img/system/rvs-1_crc-gallery-landscape-4.jpg"},
			{imgSrc:"../assets/img/system/rvs-1_crc-gallery-landscape-7.jpg"}
			]
		}
	},
	render(){
		return (<div className="banner-slide owl-carousel">{
			this.state.slideItem.map(function (img) {
				return (<div className="slide-item" style={{"background":'url('+img.imgSrc+')'}}>
		          	<div className="container">
		          		<div><a href={img.imgSrc} target="_blank"><img src="../assets/img/system/ic_download_light.svg" alt=""/></a><a href="javascript:;" className="shares-btn" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" data-content={"<a class='share-item text-left' href='#'><i class='fa fa-facebook fa-2x'></i></a><a class='share-item text-left' href='#'><i class='fa fa-instagram fa-2x'></i></a>"}><img src="../assets/img/system/ic_share_light.svg" alt=""/></a></div>
		          	</div>
		        </div>);
			})
		}</div>);
	}
});
var List = React.createClass({	
	render(){
	return (
	<div>
		<div className="mission-block container">
			<Mission1 />
		</div>
		<div className="imageslide-block container">			
			<Imgslide1 />
		</div>			
		<div className="mission-block container" style={{"margin-bottom":"30px"}}>
			<Mission2 />
		</div>
		<div className="detail-1-block dark-block">
			<div className="container detail-bar">
				<div className="tab-content" id="detail-tabContent">
					<div className="tab-pane fade show active" id="detail-item-1" role="tabpanel" aria-labelledby="detail-home-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>WHY RVS</h2>
								<span>RVS addresses the need to offer an exclusive product, an object capable of conveying emotions. An RVS is something eminently unique, in which passion and leading-edge technology are intimately blended to create sheer beauty in motion.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/rvs-1_studio-why_rvs.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-item-2" role="tabpanel" aria-labelledby="detail-profile-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>Desgin</h2>
								<span>Design and engineering are guided by vision and intuition to carve a physical, dynamic object that possesses a soul of its own, a motorcycle that goes beyond its function to become an icon of its time.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/rvs-1_studio-r_and_d.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-item-3" role="tabpanel" aria-labelledby="detail-design-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>Technology</h2>
								<span>This team has the innate ability to develop such advanced technological solutions that only superior craftsmanship and passion can handle.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/rvs-1_studio-breakthroughs.jpg)'}}></div>
					  	</div>
					</div>
				</div>
				<ul className="detail-nav nav nav-pills" id="detail-tab" role="tablist">
				  <li className="nav-item">
				    <a className="nav-link active" id="detail-home-tab" data-toggle="pill" href="#detail-item-1" role="tab" aria-controls="detail-home" aria-selected="true">
						WHY RVS
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-profile-tab" data-toggle="pill" href="#detail-item-2" role="tab" aria-controls="detail-profile" aria-selected="false">
						Design
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-design-tab" data-toggle="pill" href="#detail-item-3" role="tab" aria-controls="detail-design" aria-selected="false">
						Technology
				    </a>
				  </li>
				</ul>
			</div>
		</div>
		<div className="imageslide-block container">			
			<Imgslide2 />
		</div>
		<div className="mission-block container" style={{"margin-bottom": "30px"}}>
			<Mission3 />
		</div>
		<div className="detail-1-block dark-block">
			<Mission4 />
		</div>	
		<div className="mission-block container" style={{'margin-bottom': '30px'}}>
			<Mission5 />
		</div>	
		<div className="detail-2-block dark-block">
			<Mission6 />
		</div>
		<Introduce />		
	</div>);
	}
});
ReactDOM.render(
	<List/>,
	document.getElementById('body')
);

;(function ($, window, undefined) {    
    $(document).ready(function () {         
        $('.banner-slide').owlCarousel({
            center: true,
            loop:true,
            margin:10,
            nav:true,
            items:3,
            autoplay:true,
        })
    });
})(jQuery, window);