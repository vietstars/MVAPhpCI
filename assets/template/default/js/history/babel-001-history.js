var List = React.createClass({	
	render(){
	return (
	<div>
		<div className="history-slide-block container">
			<h3 className="hl-title"><small></small></h3>
			<div className="history-slide owl-carousel">
		        <div className="slide-item">
	          		<ul className="history-timeline">
	          			<li className="history-node">
	          				<div className="history-bar">
		          				<h3 className="history-year">1907</h3>
		          				<div className="history-item row" style={{background: 'url(../assets/img/system/Milestone-1.jpg)'}} data-toggle="modal" data-target="#history-modal">
		          					<h4 className="col align-self-center"><small>THOSE DARING YOUNG MEN IN THEIR FLYING MACHINES</small></h4>
		          				</div>
	          				</div>
	          			</li>
	          			<li className="history-node">
	          				<div className="history-bar">
		          				<h3 className="history-year">1927</h3>
		          				<div className="history-item row" style={{background: 'url(../assets/img/system/Milestone-2_1.jpg)'}} data-toggle="modal" data-target="#history-modal">
		          					<h4 className="col align-self-center"><small>FROM AIRPLANES TO MOTORCYCLES</small></h4>
		          				</div>
	          				</div>
	          			</li>
	          			<li className="history-node">
	          				<div className="history-bar">
		          				<h3 className="history-year">1945</h3>
		          				<div className="history-item row" style={{background: 'url(../assets/img/system/Milestone-3.jpg)'}} data-toggle="modal" data-target="#history-modal">
		          					<h4 className="col align-self-center"><small>THE FIRST MV BRANDED MOTORCYCLE</small></h4>
		          				</div>
	          				</div>
	          			</li>
	          			<li className="history-node">
	          				<div className="history-bar">
		          				<h3 className="history-year">1946</h3>
		          				<div className="history-item row" style={{background: 'url(../assets/img/system/Milestone-3.jpg)'}} data-toggle="modal" data-target="#history-modal">
		          					<h4 className="col align-self-center"><small>THE ROARING FORTIES</small></h4>
		          				</div>
	          				</div>
	          			</li>
	          		</ul>
		        </div>
		        <div className="slide-item">
	          		<ul className="history-timeline">
	          			<li className="history-node">
	          				<div className="history-bar">
		          				<h3 className="history-year">1907</h3>
		          				<div className="history-item row" style={{background: 'url(../assets/img/system/Milestone-1.jpg)'}} data-toggle="modal" data-target="#history-modal">
		          					<h4 className="col align-self-center"><small>THOSE DARING YOUNG MEN IN THEIR FLYING MACHINES</small></h4>
		          				</div>
	          				</div>
	          			</li>
	          			<li className="history-node">
	          				<div className="history-bar">
		          				<h3 className="history-year">1927</h3>
		          				<div className="history-item row" style={{background: 'url(../assets/img/system/Milestone-2_1.jpg)'}} data-toggle="modal" data-target="#history-modal">
		          					<h4 className="col align-self-center"><small>FROM AIRPLANES TO MOTORCYCLES</small></h4>
		          				</div>
	          				</div>
	          			</li>
	          		</ul>	          		
		        </div>
		  	</div>
		</div>
		<div className="introduce-block container">			
			<h3 className="hl-title">EXPLORE MV AGUSTA<small></small></h3>
			<div className="row">
				<div className="col-md-4 eq-height">
					<div className="bg-white">
						<a href="../news">
							<div className="intro-img" style={{background:'url(../assets/img/system/mva-news-square.jpg)'}}></div>
							<div className="intro-text">
								<h3 className="intro-title">News</h3>
								<div className="intro-description">Keep up with the latest news.</div>
							</div>
						</a>
					</div>
				</div>
				<div className="col-md-4 eq-height">
					<div className="bg-white">
						<a href="../about">
							<div className="intro-img" style={{background:'url(../assets/img/system/mva-about-us_hero-square.jpg)'}}></div>
							<div className="intro-text">
								<h3 className="intro-title">This is us</h3>
								<div className="intro-description">We do not simply build motorcycles, we craft emotions. We look at the future to build machines that are always one step ahead.</div>
							</div>
						</a>
					</div>
				</div>
				<div className="col-md-4 eq-height">
					<div className="bg-white">
						<a href="../crc">
							<div className="intro-img" style={{background:'url(../assets/img/system/mva_crc_hero_square.jpg)'}}></div>
							<div className="intro-text">
								<h3 className="intro-title">Castiglioni Research Centre</h3>
								<div className="intro-description">Located in the Republic of San Marino, the Castiglioni Research Centre (CRC) was created in 1993 by Claudio Castiglioni.</div>
							</div>
						</a>
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

;(function ($, window, undefined) {
    
    $(document).ready(function () {         
        $('.history-slide').owlCarousel({
            loop:true,
            nav:true,
            items:1,
            margin:15,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            autoplay:true,
            autoHeight:true,
        })
    });
})(jQuery, window);