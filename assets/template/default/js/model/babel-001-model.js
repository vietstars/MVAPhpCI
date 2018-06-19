var List = React.createClass({	
	render(){
	return (
	<div>		
		<div className="highlight-block container">
			<h3 className='hl-title'>Colours<small></small></h3>
			<div className="tab-content" id="pills-tabContent">
			  <div className="tab-pane fade show active" id="pills-item-1" role="tabpanel" aria-labelledby="pills-home-tab">
			  	<div className="row">
					<div className="highlight-img col-md-12"><img src="../assets/img/system/b3rr00003_0.png" /></div>
			  	</div>
			  </div>
			  <div className="tab-pane fade" id="pills-item-2" role="tabpanel" aria-labelledby="pills-profile-tab">
			  	<div className="row">
					<div className="highlight-img col-md-12"><img src="../assets/img/system/b3rr00004.png" /></div>
			  	</div>
			  </div>
			</div>
			<ul className="colours-bike nav nav-pills row justify-content-center" id="pills-tab" role="tablist">
			  <li className="nav-item">
			    <a className="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-item-1" role="tab" aria-controls="pills-home" aria-selected="true">
					RED/BLACK
			    </a>
			  </li>
			  <li className="nav-item">
			    <a className="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-item-2" role="tab" aria-controls="pills-profile" aria-selected="false">
					WHITE/BLACK
			    </a>
			  </li>
			</ul>
			<h4 className="colour-descript text-center">PEARL SHOCK RED/METALLIC CARBON BLACK</h4>
		</div>
		<div className="spec-block container">
			<h3 className='hl-title'>TECHNICAL SPECIFICATIONS<small></small></h3>
			<div className="row spec-bar">
				<div className="col-md-6">
					<div className="spec-field">
						<small>Engine Type</small>Three cylinder, 4 stroke, 12 valve
					</div>
				</div>
				<div className="col-md-6">
					<div className="spec-field">
						<small>Frame type</small>ALS Steel tubular trellis
					</div>
				</div>
			</div>
			<div className="row spec-bar">
				<div className="col-md-6">
					<div className="spec-field">
						<small>Engine total displacement</small>798 cm3 (48.68 cu. in.)
					</div>
				</div>
				<div className="col-md-6">
					<div className="spec-field">
						<small>Front Suspension</small>Marzocchi "UPSIDE DOWN" telescopic hydraulic fork
					</div>
				</div>
			</div>
			<div className="row spec-bar">
				<div className="col-md-6">
					<div className="spec-field">
						<small>Engine maximum power</small>103 kW (140 hp) at 12.300 r.p.m.
					</div>
				</div>
				<div className="col-md-6">
					<div className="spec-field">
						<small>Rear Suspension</small>Progressive Sachs, single shock adsorber
					</div>
				</div>
			</div>
			<div className="row spec-bar">
				<div className="col-md-6">
					<div className="spec-field">
						<small>Engine maximum torque</small>87 Nm (8.87 kgm) at 10.100 r.p.m
					</div>
				</div>
				<div className="col-md-6">
					<div className="spec-field">
						<small>Front Brake + ABS system</small>Ø 320 mm (Ø 12.6 in.) double floating disc
					</div>
				</div>
			</div>
			<div className="row spec-bar">
				<div className="col-md-6">
					<div className="spec-field">
						<small>Engine management system</small>Integrated ignition - injection system MVICS 2.0
					</div>
				</div>
				<div className="col-md-6">
					<div className="spec-field">
						<small>Rear Brake + ABS system</small>Ø 220 mm (Ø 8.66 in.) single steel disc
					</div>
				</div>
			</div>
			<div className="row spec-bar">
				<div className="col-md-6">
					<div className="spec-field">
						<small>Electronic Quick-shift</small>MV EAS 2.0 (Electronically assisted Shift up&down)
					</div>
				</div>
				<div className="col-md-6">
					<div className="spec-field">
						<small>Maximum speed</small>244.0 km/h (151.6 mph)
					</div>
				</div>
			</div>
			<div className="row spec-bar">
				<div className="col-md-6">
					<div className="spec-field">
						<small>Clutch</small>Multi-disk wet clutch with hydraulic actuation
					</div>
				</div>
				<div className="col-md-6">
					<div className="spec-field">
						<small>Dry weight</small>175 kg (385,80 lbs.)
					</div>
				</div>
			</div>
			<a href="#" className="btn btn-outline-dark btn-download pull-right">Download technical sheet</a>
		</div>
		<div className="detail-1-block dark-block">
			<div className="container detail-bar">
				<div className="tab-content" id="detail-tabContent">
					<div className="tab-pane fade show active" id="detail-item-1" role="tabpanel" aria-labelledby="detail-home-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>THE BEST MIDDLE-WEIGHT NAKED</h2>
								<span>An evolution of the original Brutale, the iconic four-cylinder that rocked the very concept of sports naked.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/brutale-800-rr_story-road.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-item-2" role="tabpanel" aria-labelledby="detail-profile-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>IT'S AN RR!</h2>
								<span>LED lights, balanced volumes, compact, attention to ergonomics and details: these are the traits that make the Brutale 800 RR quite unique, since its inception. A reference for functionality and style.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/brutale-800-rr_details.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-item-3" role="tabpanel" aria-labelledby="detail-design-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>BRUTALE 800 RR, AN INSTANT ICON</h2>
								<span>The “extreme” naked, for maximum performance and the sportiest ride. Dual seat, concealed passenger handles, signature lights and lightweight sub-frame are only some of the many elements that made the Brutale 800 an instant icon.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/brutale-800-rr_sketch-dark.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-item-4" role="tabpanel" aria-labelledby="detail-perform-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5 align-self-center">
								<h2>BE IN CONTROL</h2>
								<span>Feel the air rushing past your face, hold on to the handlebars with all your strength. Feel the exhilarating acceleration. Enjoy the perfection of the bends. Emotions to be shared with your partner, or kept to yourself. You're in control.</span>
					  		</div>
							<div className="detail-img col-md-7" style={{'background':'url(../assets/img/system/brutale-800-rr_performance.jpg)'}}></div>
					  	</div>
					</div>
				</div>
				<ul className="detail-nav nav nav-pills" id="detail-tab" role="tablist">
				  <li className="nav-item">
				    <a className="nav-link active" id="detail-home-tab" data-toggle="pill" href="#detail-item-1" role="tab" aria-controls="detail-home" aria-selected="true">
						STORY
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-profile-tab" data-toggle="pill" href="#detail-item-2" role="tab" aria-controls="detail-profile" aria-selected="false">
						details
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-design-tab" data-toggle="pill" href="#detail-item-3" role="tab" aria-controls="detail-design" aria-selected="false">
						design
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-perform-tab" data-toggle="pill" href="#detail-item-4" role="tab" aria-controls="detail-perform" aria-selected="false">
						performance
				    </a>
				  </li>
				</ul>
			</div>
		</div>
		<div className="detail-2-block">
			<div className="container detail-bar">
				<div className="tab-content" id="detail-2-tabContent">
					<div className="tab-pane fade show active" id="detail-2-item-1" role="tabpanel" aria-labelledby="detail-home-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-8 align-self-center">
					  			<div className="row"> 
									<div className="col-md-6">
										<h2>LESS NOISE, MORE SOUND</h2>
									</div>
					  			</div>
					  			<div className="row">
					  				<div className="col-md-6">
					  					<span>The technical improvements on the new Brutale 800 RR become quite evident when considering some of the many new features: a new countershaft and a redesigned primary; the optimisation of the manifold and cam </span>
					  				</div>
					  				<div className="col-md-6">					  					
					  					<span>phasing; the redesigned valve guides. The list is quite extensive, and includes new engineered covers to dampen noise and offer increased engine protection.</span>
					  				</div>
					  			</div>								
					  		</div>
							<div className="detail-img col-md-4" style={{'background':'url(../assets/img/system/brutale-800-rr_technology-studio.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-2-item-2" role="tabpanel" aria-labelledby="detail-profile-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-8 align-self-center">
					  			<div className="row"> 
									<div className="col-md-6">
										<h2>PURE ADRENALINE</h2>
									</div>
					  			</div>
					  			<div className="row">
					  				<div className="col-md-6">
					  					<span>Above all, RR means power. At its peak it reaches 140 HP at 13.100 rpm with a torque of 86Nm at 10.100 rpm. Impressive numbers considering the drastic reduction of noise and emissions imposed by Euro 4 regulations. The </span>
					  				</div>
					  				<div className="col-md-6">
					  					<span>Above all, RR means power. At its peak it reaches 140 HP at 13.100 rpm with a torque of 86Nm at 10.100 rpm. Impressive numbers considering the drastic reduction of noise and emissions imposed by Euro 4 regulations. The </span>				  					
					  				</div>
					  			</div>								
					  		</div>
							<div className="detail-img col-md-4" style={{'background':'url(../assets/img/system/brutale-800-rr_engine-studio_1.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-2-item-3" role="tabpanel" aria-labelledby="detail-design-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-8 align-self-center">
					  			<div className="row"> 
									<div className="col-md-6">
										<h2>LATEST GENERATION ELECTRONICS</h2>
									</div>
					  			</div>
					  			<div className="row">
					  				<div className="col-md-6">
					  					<span>The most recent evolution of the MVICS system includes full multi-map Ride By Wire throttle control, with a choice of four riding </span>
					  				</div>
					  				<div className="col-md-6">
					  					<span>modes, 8-level adjustable traction control and up & down EAS 2.0 electronic gearbox complementing the hydraulic slipper clutch.</span>					  					
					  				</div>
					  			</div>								
					  		</div>
							<div className="detail-img col-md-4" style={{'background':'url(../assets/img/system/brutale-800-rr_electronics.jpg)'}}></div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-2-item-4" role="tabpanel" aria-labelledby="detail-perform-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-8 align-self-center">
					  			<div className="row"> 
									<div className="col-md-6">
										<h2>TECHNOLOGY MEANS SAFETY</h2>
									</div>
					  			</div>
					  			<div className="row">
					  				<div className="col-md-6">
					  					<span>The latest generation, two-channel BOSCH 9 PLUS ABS is compact and extremely lightweight, two features that make it ideal for a sports naked. The RLM (Rear Wheel Lift-</span>
					  				</div>
					  				<div className="col-md-6">
					  					<span>nt brake in order to keep the rear wheel on the ground even under extreme braking conditions.</span>
					  				</div>
					  			</div>
					  		</div>
							<div className="detail-img col-md-4" style={{'background':'url(../assets/img/system/brutale-800-rr_safety.jpg)'}}></div>
					  	</div>
					</div>
				</div>
				<ul className="detail-nav nav nav-pills" id="detail-tab" role="tablist">
				  <li className="nav-item">
				    <a className="nav-link active" id="detail-home-tab" data-toggle="pill" href="#detail-2-item-1" role="tab" aria-controls="detail-home" aria-selected="true">
						technology
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-profile-tab" data-toggle="pill" href="#detail-2-item-2" role="tab" aria-controls="detail-profile" aria-selected="false">
						engine
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-design-tab" data-toggle="pill" href="#detail-2-item-3" role="tab" aria-controls="detail-design" aria-selected="false">
						electronics
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-perform-tab" data-toggle="pill" href="#detail-2-item-4" role="tab" aria-controls="detail-perform" aria-selected="false">
						safety 
				    </a>
				  </li>
				</ul>
			</div>
		</div>
		<div className="image-slide-block">
			<div className="image-slide owl-carousel">
		        <div className="slide-item" style={{'background':'url(../assets/img/system/ambient2.jpg)'}}>
		        	<div className="container">
		          		<div><a href="../assets/img/system/ambient2.jpg" target="_blank"><img src="../assets/img/system/ic_download_light.svg" alt="" /></a><a href="javascript:;"className="shares-btn" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" data-content={"<a className='share-item text-left' href='#'><i className='fa fa-facebook fa-2x'></i></a><a className='share-item text-left' href='#'><i className='fa fa-instagram fa-2x'></i></a>"}><img src="../assets/img/system/ic_share_light.svg" alt="" /></a></div>
		          	</div>
		        </div>
		        <div className="slide-item" style={{'background':'url(../assets/img/system/ambient3.jpg)'}}>
		        	<div className="container">
		          		<div><a href="../assets/img/system/ambient3.jpg" target="_blank"><img src="../assets/img/system/ic_download_light.svg" alt="" /></a><a href="javascript:;"className="shares-btn" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" data-content={"<a className='share-item text-left' href='#'><i className='fa fa-facebook fa-2x'></i></a><a className='share-item text-left' href='#'><i className='fa fa-instagram fa-2x'></i></a>"}><img src="../assets/img/system/ic_share_light.svg" alt="" /></a></div>
		          	</div>
		        </div>
		        <div className="slide-item" style={{'background':'url(../assets/img/system/ambient4.jpg)'}}>
		        	<div className="container">
		          		<div><a href="../assets/img/system/ambient4.jpg" target="_blank"><img src="../assets/img/system/ic_download_light.svg" alt="" /></a><a href="javascript:;"className="shares-btn" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" data-content={"<a className='share-item text-left' href='#'><i className='fa fa-facebook fa-2x'></i></a><a className='share-item text-left' href='#'><i className='fa fa-instagram fa-2x'></i></a>"}><img src="../assets/img/system/ic_share_light.svg" alt="" /></a></div>
		          	</div>
		        </div>
		        <div className="slide-item" style={{'background':'url(../assets/img/system/ambient5.jpg)'}}>
		        	<div className="container">
		          		<div><a href="../assets/img/system/ambient5.jpg" target="_blank"><img src="../assets/img/system/ic_download_light.svg" alt="" /></a><a href="javascript:;"className="shares-btn" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" data-content={"<a className='share-item text-left' href='#'><i className='fa fa-facebook fa-2x'></i></a><a className='share-item text-left' href='#'><i className='fa fa-instagram fa-2x'></i></a>"}><img src="../assets/img/system/ic_share_light.svg" alt="" /></a></div>
		          	</div>
		        </div>
		  	</div>
		</div>	
	</div>);
	}
});
ReactDOM.render(
	<List/>,
	document.getElementById('body')
);