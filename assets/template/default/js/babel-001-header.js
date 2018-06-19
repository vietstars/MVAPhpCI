var HeaderNav = React.createClass({
	render(){
return (<nav className="navbar menu-top navbar-expand-lg container fixed-top">
			<a className="navbar-brand" href="../index"><img src="../assets/img/system/mva-Logo_Nav.png" width="85px" alt="logo"/></a>
			<button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span className="navbar-toggler-icon"></span>
			</button>
			<div className="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul className="navbar-nav mr-auto">
			      <li className="nav-item">
			        <a className="nav-link models-block" href="javascript:;" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom">Models <span className="sr-only">(current)</span></a>
			      </li>
			      <li className="nav-item">
			        <a className="nav-link company-block" href="javascript:;" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom">company</a>
			      </li>
			      <li>
			        <a className="nav-link" href="#">VISIT MV STORE</a>
			      </li>
			    </ul>
			    <form className="form-inline my-2 my-lg-0">
					<ul className="navbar-nav mr-auto">
				      <li className="nav-item">
				        <a className="nav-link language-block" href="javascript:;" data-html="true" data-toggle="popover" data-trigger="hover focus" data-placement="bottom">Language</a></li>
				      <li className="nav-item dealer-item">
				        <a className="nav-link" href="#">dealer</a></li>
				    </ul>
			    </form>
			</div></nav>);
	}
});
ReactDOM.render(
	<HeaderNav />,
	document.getElementById('header-nav')
);

;(function ($, window, undefined) {
    
    $(document).ready(function () {      
        $('.language-block').popover({
          trigger: 'hover focus',
          template: '<div class="popover" role="tooltip"><div class="popover-body"></div></div>',
          content: '<a class="language-item text-left" href="123">EN</a><a class="language-item text-left" href="456">IT</a>'
        })      
        $('.shares-btn').popover({
          trigger: 'hover focus',
          template:'<div class="popover" role="tooltip"><div class="popover-body social-btn"></div></div>',
        })
        $('.models-block').popover({
          trigger: 'hover focus',
          template:'<div class="popover top-menu" role="tooltip"><div class="popover-body"></div></div>',
          content: '<div class="container">'+
            '<div class="row">'+
                '<div class="col-md-2 eq-height bg-white menu-left-top">'+
                    '<ul class="pages-link"><h6><a href="javascript:;">Categories</a></h6>'+
                        '<li><a href="javascript:;" class="show-menu active" data-target=".topmenu-streets">Streets</a></li>'+
                        '<li><a href="javascript:;" class="show-menu" data-target=".topmenu-tourer">Tourer</a></li>'+
                        '<li><a href="javascript:;" class="show-menu" data-target=".topmenu-supersports">SuperSports</a></li>'+
                        '<li><a href="javascript:;" class="show-menu" data-target=".topmenu-special">Special Edition</a></li>'+
                    '</ul>'+
                '</div>'+
                '<div class="col-md-10 eq-height bg-white models-content topmenu-streets active animation-expand">'+
                '<div class="row">'+
                    '<div class="col-md-2 models-bar">'+
                        '<ul class="models-link"><h6><a href="javascript:;">Brutale</a></h6>'+
                            '<li><a href="javascript:;" class="show-model active" data-target=".model-B-800">800</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-B-800-RR">800 RR</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-B-800-RR-A">800 RR America</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-B-800-RR-P">800 RR Pirelli</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-B-800-RC">800 RC</a></li>'+
                            '<h6><a href="javascript:;">Dragster</a></h6>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-D-800-RR-2017">800 RR 2017</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-D-800-RC">800 RC 2017</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-D-800-RR-2018">800 RR 2018</a></li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-B-800 active" style="background:url();">'+
                        '<h6>Brutale 800</h6><h3>NAKED POWER.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>109</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>237</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>175</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>13.890*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/brutale-800hero-square-20.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-B-800-RR" style="background:url();">'+
                        '<h6>Brutale 800 RR</h6><h3>Power, more is better.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>140</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>244</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>175</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>15.770*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/brutale-800-rr_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-B-800-RR-A" style="background:url();">'+
                        '<h6>Brutale 800 RR American</h6><h3>Italian style, American flair.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>140</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>244</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>175</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>17.990*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/brutale-800-america_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-B-800-RR-P" style="background:url();">'+
                        '<h6>Brutale 800 RR Pirelli</h6><h3>Beauty isn\'t only skin deep.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>140</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>244</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>175</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>19.000*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/brutale-800-rr-pirelli_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-B-800-RC" style="background:url();">'+
                        '<h6>Brutale 800 RC</h6><h3>Performance, technology, sophistication.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>150</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>244</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>167</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>19.990*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/brutale-800-rc_hero_square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-D-800-RR-2017" style="background:url();">'+
                        '<h6>Dragster 800 RR 2017</h6><h3>Born to impress.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>140</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>245</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>168</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>18.490*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/dragster-800-rr-2017_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-D-800-RC" style="background:url();">'+
                        '<h6>Dragster 800 RC 2017</h6><h3>Naked muscles.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>150</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>245</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>160</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>21.990*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/dragster-800-rc_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-D-800-RR-2018" style="background:url();">'+
                        '<h6>Dragster 800 RR 2018</h6><h3>Shocking acceleration.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>140</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>244</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>168</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>18.900*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/dragster-800-rr-2018_hero-square-1.png" alt=""/>'+
                    '</div>'+
                '</div></div>'+
                '<div class="col-md-10 eq-height bg-white models-content topmenu-tourer animation-expand">'+
                '<div class="row">'+
                    '<div class="col-md-2 models-bar">'+
                        '<ul class="models-link"><h6><a href="javascript:;">Turismo Veloce</a></h6>'+
                            '<li><a href="javascript:;" class="show-model active" data-target=".model-T-800">800</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-T-800-L">800 LUSSO</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-T-800-RC">800 RC</a></li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-T-800 active" style="background:url();">'+
                        '<h6>Turismo Veloce 800</h6><h3>Further. Faster.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>110</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>230</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>191</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>16.990*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/turismo-veloce-800_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-T-800-L" style="background:url();">'+
                        '<h6>Turismo Veloce 800 LUSSO</h6><h3>Further. Faster. In luxury.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>110</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>230</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>192</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>19.690*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/turismo-veloce-800-lusso_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-T-800-RC" style="background:url();">'+
                        '<h6>Turismo Veloce 800 RC</h6><h3>The everyday F3.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>110</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>230</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>192</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>22.390*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/turismo-veloce-800-rc_hero-square-1.png" alt=""/>'+
                    '</div>'+
                '</div></div>'+
                '<div class="col-md-10 eq-height bg-white models-content topmenu-supersports animation-expand">'+
                '<div class="row">'+
                    '<div class="col-md-2 models-bar">'+
                        '<ul class="models-link"><h6><a href="javascript:;">F3</a></h6>'+
                            '<li><a href="javascript:;" class="show-model active" data-target=".model-F3-675">675</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-F3-800">800</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-F3-800-RC">800 RC</a></li>'+
                            '<h6><a href="javascript:;">F4</a></h6>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-F4">F4</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-F4-RR">F4 RR</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-F4-RC">F4 RC</a></li>'+
                            '<li><a href="javascript:;" class="show-model" data-target=".model-F4-LH">F4 LH 44</a></li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-F3-675 active" style="background:url();">'+
                        '<h6>F3 675</h6><h3>WORLD SUPERSPORT DNA.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>674</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>128</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>251</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>173</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>15.490*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/f3-675_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-F3-800" style="background:url();">'+
                        '<h6>F3 800</h6><h3>STREET-LEGAL SUPERSPORT.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>148</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>240</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>173</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>17.290*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/f3-800_hero-square.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-F3-800-RC" style="background:url();">'+
                        '<h6>F3 800 RC</h6><h3>TRACK DAY WEAPON.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>153</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>240</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>165</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>20.990*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/f3-800-rc_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-F4" style="background:url();">'+
                        '<h6>F4</h6><h3>THE ICON.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>4</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>998</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>195</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>291</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>191</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>20.900*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/f4-1000_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-F4-RR" style="background:url();">'+
                        '<h6>F4 RR</h6><h3>RAW POWER.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>4</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>998</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>201</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>298</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>190</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>27.900*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/f4-rr_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-F4-RC" style="background:url();">'+
                        '<h6>F4 RC</h6><h3>STREET-LEGAL SUPERBIKE.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>4</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>998</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>212</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>302</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>175</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>40.900*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/f3-rc_hero-square-1.png" alt=""/>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-F4-LH" style="background:url();">'+
                        '<h6>F4 LH 44</h6><h3>THE CHOICE OF F1 WORLD CHAMPION LEWIS HAMILTON.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>4</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>998</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>212</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>302</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>175</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>64.444*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/f4-lh44_hero-square-1.png" alt=""/>'+
                    '</div>'+
                '</div></div>'+
                '<div class="col-md-10 eq-height bg-white models-content topmenu-special animation-expand"><div class="row"><div class="col-md-2 models-bar">'+
                        '<ul class="models-link"><h6><a href="javascript:;">RVS</a></h6>'+
                            '<li><a href="javascript:;" class="show-model active" data-target=".model-RVS">RVS #1</a></li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="col-md-10 model-specification model-RVS active" style="background:url();">'+
                        '<h6>RVS #1</h6><h3>EXTREME AND EXCLUSIVE.</h3>'+
                        '<ul class="row">'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS</small>3</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">CYLINDERS CAPACITY (CC)</small>798</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">HORSEPOWER (HP)</small>150</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">MAXIMUM SPEED (KM/H)</small>245</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">DRY WEIGHT (KG)</small>160</h3></li>'+
                            '<li class="col-md-4"><h3><small class="with-border">STARTING PRICE (€)</small>36.000*</h3></li>'+
                        '</ul>'+
                        '<img src="../assets/img/system/rvs-1_hero-square-1.png" alt=""/>'+
                    '</div>'+
                '</div></div>'+
            '</div>'+
        '</div>'
        }) 
        $('.company-block').popover({
          trigger: 'hover focus',
          template:'<div class="popover top-menu" role="tooltip"><div class="popover-body"></div></div>',
          content: '<div class="container">'+
            '<div class="row">'+
                '<div class="col-md-2 eq-height bg-white menu-left-top">'+
                    '<ul class="pages-link"><h6><a href="javascript:;">company</a></h6><li><a href="../about" class="show-menu active" data-target=".topmenu-aboutus">ABOUT US</a></li><li><a href="../history" class="show-menu" data-target=".topmenu-history">HISTORY</a></li><li><a href="../news" class="show-menu" data-target=".topmenu-news">NEWS</a></li><li><a href="../crc" class="show-menu" data-target=".topmenu-crc">CRC</a></li><li><a href="../contact" class="show-menu" data-target=".topmenu-contact">CONTACT</a></li></ul>'+
                '</div>'+
                '<div class="col-md-10 eq-height bg-white topmenu-aboutus active animation-expand" style="background:url(\'../assets/img/system/mva-about-us_hero-square.jpg\');"><h3 class="aboutus-content">This is us<small>We do not simply build motorcycles, we craft emotions. We look at the future to build machines that are always one step ahead.</small></h3></div>'+
                '<div class="col-md-10 eq-height bg-white topmenu-history animation-expand" style="background:url(\'../assets/img/system/mva-history-podium-square.jpg\');"><h3 class="contact-content">A GREAT STORY<small>Passion, racing, victories. From aeronautics to motorcycles. A history made of people, joys and drama.</small></h3><div class="row his-detail"><div class="col-md-4 eq-height"><div class="border-his"><img src="../assets/img/system/ic_trophy.svg"/><span>37 World Titles as a Constructor</span></div></div><div class="col-md-4 eq-height"><div class="border-his"><img src="../assets/img/system/ic_trophy.svg"/><span>270 Grand Prix Titles</span></div></div><div class="col-md-4 eq-height"><div class="border-his"><img src="../assets/img/system/ic_trophy.svg"/><span>3028 Champions on the podium</span></div></div></div></div>'+
                '<div class="col-md-10 eq-height bg-white topmenu-news animation-expand" style="background:url(\'../assets/img/system/mva-news-square.jpg\');"><h3 class="news-content">MV HOLDING: ACQUISITIONS AND INVESTMENTS<small>MV HOLDING completes the aquisition of the share capital held by Mercedes AMG in MV Agusta Motor S.P.A. and invests on the new 4 Cylinder platform</small></h3><a href="../news/123" class="read-more">Read more</a><h3 class="news-content with-top-border">THE 2018 MODEL RANGE<small>Varese, November 15, 2017 – During EICMA, the most renowned motorcycle show in the world, the all new MV Agusta Dragster 800 RR was voted among the 3 most beautiful bikes of the year.</small></h3><a href="../news/123" class="read-more">Read more</a></div>'+
                '<div class="col-md-10 eq-height bg-white topmenu-crc animation-expand" style="background:url(\'../assets/img/system/mva_crc_hero_square.jpg\');"><h3 class="contact-content">CRC<small>Located in the Republic of San Marino, the Castiglioni Research Centre (CRC) was created in 1993 by Claudio Castiglioni.</small></h3></div>'+
                '<div class="col-md-10 eq-height bg-white topmenu-contact animation-expand" style="background:url(\'../assets/img/system/mva_contact_us_square.jpg\');"><h3 class="contact-content">Contact MV AGUSTA SINGAPORE<small>Keep in touch with your passion.</small></h3><ul class="contact-detail"><li class="contact-item"><img src="../assets/img/system/ic_location.svg" alt="" />411 Changi Road, Singapore 419860</li><li class="contact-item"><img src="../assets/img/system/ic_phone.svg" alt="" />+65 6743 7030</li><li class="contact-item"><img src="../assets/img/system/ic_mail.svg" alt="" />contact@yewheng.com</li></ul></div>'+
            '</div>'+
        '</div>'
        }) 
        $(document).on('mouseenter','.show-menu',function () {
            var _target=$(this).data('target');
            $(this).parent().siblings('li').children('a').removeClass('active');
            $(this).parent().parent().parent().siblings('.eq-height').not(_target).hide().removeClass('active');
            $(_target).show().addClass('active');
            $(this).addClass('active');
        }) 
        $(document).on('mouseenter','.show-model',function () {
            var _target=$(this).data('target');
            $(this).parent().siblings('li').children('a').removeClass('active');
            $(this).parent().parent().parent().siblings('.model-specification').not(_target).hide().removeClass('active');
            $(_target).show().addClass('active');
            $(this).addClass('active');
        })  
        $('[data-toggle="popover"]').not('.language-block').on('show.bs.popover', function () {
            $(document).find('.nav-item a').removeClass('active');
            $(this).addClass('active');
        })    
        $('[data-toggle="popover"]').not('.language-block').on('hidden.bs.popover', function () {
            $(document).find('.nav-item a').removeClass('active');
        }) 
    });
})(jQuery, window);
