var Contact = React.createClass({
	render(){
	return (
		<div className="detail-block dark-block">
			<div className="detail-bar">
				<div className="tab-content" id="detail-tabContent">
					<div className="tab-pane fade show active" id="detail-item-1" role="tabpanel" aria-labelledby="detail-home-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5">
								<h2>YEW HENG GROUP</h2>
								<span>Started in 1980, Yew Heng Motor Company; founded by Mr. Philip Ang started operations at a small shop house along Changi Road and business blossomed as years passed by.<br/>Today, the company has grown to encompass many areas of the transportation industry and beyond. We continue on our founder’s vision of whole-hearted customer service, coupled with highly innovative approaches to progress and evolving alongside Singapore’s bright future.</span>
								<ul>
									<h4>CONTACT DETAILS</h4>
									<li><img src="../assets/img/system/ic_location_white.svg" alt=""/>411 Changi Road, Singapore 419860</li>
									<li><img src="../assets/img/system/ic_phone_white.svg" alt=""/> +65 6743 7030</li>
									<li><img src="../assets/img/system/ic_mail_white.svg" alt=""/> contact@yewheng.com</li>
								</ul>
								<ul>
									<h4>SOCIAL MEDIA</h4>
									<li><img src="../assets/img/system/ic_youtube.svg" alt=""/>www.youtube.com/user/MVAgustaMotorSpA</li>
									<li><img src="../assets/img/system/ic_facebook.svg" alt=""/>www.facebook.com/MV-Agusta-Singapore-Official-394652770714642/</li>
									<li><img src="../assets/img/system/ic_instagram.svg" alt=""/>www.instagram.com/mvagustamotor/</li>
								</ul>
								<a href="mailto:contact@yewheng.com" className="btn btn-outline-primary">send us an e-mail</a>								
					  		</div>
							<div className="detail-map col-md-7">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5640.958633558915!2d103.90815193997408!3d1.3196485194443885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da1806552b74ab%3A0x3daebd09de678cb2!2sYew+Heng+Group+Pte.+Ltd.!5e0!3m2!1svi!2s!4v1527485706071" width="100%" height="950" frameborder="0" style={{'border':'0'}} allowfullscreen></iframe>
							</div>
					  	</div>
					</div>
					<div className="tab-pane fade" id="detail-item-2" role="tabpanel" aria-labelledby="detail-profile-tab">
					  	<div className="row">
					  		<div className="detail-content col-md-5">
								<h2>YEW HENG GROUP</h2>
								<span>Started in 1980, Yew Heng Motor Company; founded by Mr. Philip Ang started operations at a small shop house along Changi Road and business blossomed as years passed by.<br/>Today, the company has grown to encompass many areas of the transportation industry and beyond. We continue on our founder’s vision of whole-hearted customer service, coupled with highly innovative approaches to progress and evolving alongside Singapore’s bright future.</span>
								<ul>
									<h4>CONTACT DETAILS</h4>
									<li><img src="../assets/img/system/ic_location_white.svg" alt=""/>411 Changi Road, Singapore 419860</li>
									<li><img src="../assets/img/system/ic_phone_white.svg" alt=""/> +65 6743 7030</li>
									<li><img src="../assets/img/system/ic_mail_white.svg" alt=""/> contact@yewheng.com</li>
								</ul>
								<ul>
									<h4>SOCIAL MEDIA</h4>
									<li><img src="../assets/img/system/ic_youtube.svg" alt=""/>www.youtube.com/user/MVAgustaMotorSpA</li>
									<li><img src="../assets/img/system/ic_facebook.svg" alt=""/>www.facebook.com/MV-Agusta-Singapore-Official-394652770714642/</li>
									<li><img src="../assets/img/system/ic_instagram.svg" alt=""/>www.instagram.com/mvagustamotor/</li>
								</ul>
								<a href="mailto:contact@yewheng.com" className="btn btn-outline-primary">send us an e-mail</a>								
					  		</div>
							<div className="detail-map col-md-7">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5640.958633558915!2d103.90815193997408!3d1.3196485194443885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da1806552b74ab%3A0x3daebd09de678cb2!2sYew+Heng+Group+Pte.+Ltd.!5e0!3m2!1svi!2s!4v1527485706071" width="100%" height="950" frameborder="0" style={{'border':'0'}} allowfullscreen></iframe>
							</div>
					  	</div>
					</div>					
				</div>
				<ul className="detail-nav nav nav-pills" id="detail-tab" role="tablist">
				  <li className="nav-item">
				    <a className="nav-link active" id="detail-home-tab" data-toggle="pill" href="#detail-item-1" role="tab" aria-controls="detail-home" aria-selected="true">
						THE company
				    </a>
				  </li>
				  <li className="nav-item">
				    <a className="nav-link" id="detail-profile-tab" data-toggle="pill" href="#detail-item-2" role="tab" aria-controls="detail-profile" aria-selected="false">
						THE MUSEUM
				    </a>
				  </li>
				</ul>
			</div>
		</div>
		);
	}
});
var List = React.createClass({	
	render(){
	return (
	<div>		
		<Contact />		
	</div>);
	}
});
ReactDOM.render(
	<List/>,
	document.getElementById('body')
);