var FooterBar = React.createClass({
	render(){
return (<div className="footer">
			<div className="top-logo">
				<div className="container logo-container">
					<img src="../assets/img/system/mva-Logo_Footer.png" />
				</div>
			</div>
			<div className="bottom-content container">
				<div className="row">
					<div className="col-md-3">
						<h6 className="content-title">models</h6>
						<ul className="model-link">
							<li><a href="#">BRUTALE</a></li>
							<li><a href="#">DRAGSTER</a></li>
							<li><a href="#">TURISMO VELOCE</a></li>
							<li><a href="#">F3</a></li>
							<li><a href="#">F4</a></li>
							<li><a href="#">RVS</a></li>
						</ul>
					</div>					
					<div className="col-md-3">
						<h6 className="content-title">company</h6>
						<ul className="model-link">
							<li><a href="../about">ABOUT US</a></li>
							<li><a href="../history">HISTORY</a></li>
							<li><a href="../news">NEWS</a></li>
							<li><a href="../crc">CRC</a></li>
							<li><a href="../contact">CONTACT</a></li>
						</ul>
						<h6 className="content-title">DEALERS</h6>
						<ul className="model-link">
							<li><a href="#">FIND A DEALER</a></li>
						</ul>
					</div>
					<div className="col-md-6">
						<div className="col-md-8">
							<h6 className="content-title">FOLLOW US ON SOCIAL MEDIA</h6>
							<div className="social-button">
								<a href="#" className="social-button"><i className="fa fa-instagram"></i></a>
								<a href="#" className="social-button"><i className="fa fa-facebook"></i></a>
								<a href="#" className="social-button"><i className="fa fa-youtube-play"></i></a>
							</div>
							<h6 className="content-title">NEWSLETTER</h6>
							<div className="subscribe-form">
								<form>
								  	<div className="form-group">
									    <input type="email" className="form-control subscribe-email" id="subscribe-email" placeholder="E-mail address" />
								  	</div>
								  	<button type="submit" className="btn">Subscribe</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div className="row">
					<div className="recommends-bar">
						<img src="../assets/img/system/Motul_logo.png" width="118px" alt="" /> MV Agusta recommends Motul
					</div>
					<div className="copyright">
						<h6>PRIVACY AND LEGAL RMI</h6>
						<small>2018 MV AGUSTA Motor S.p.A - Via G. Macchi, 144-21100 Varese</small>
					</div>
				</div>
			</div>
		</div>);
	}
});
ReactDOM.render(
	<FooterBar />,
	document.getElementById('footer')
);