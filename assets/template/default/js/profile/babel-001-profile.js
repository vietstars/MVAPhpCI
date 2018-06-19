var tbody;
var Trow = React.createClass({	
	removeTrow(){
		var checking=confirm('Do you want remove this user?');
		if(checking){
			fetch("http://dev.vn/api/home/users",{
	          	method: "DELETE",
	          	headers: {
	              	'Accept': 'application/json',
	                'Content-Type': ' application/json',
	                'X-API-KEY': 'CODEX@123',
	                'Authorization': 'Basic YWRtaW46MTIzNA==',
	            },
	            body: "id="+this.props.id,
	        })
		    .then(res => res.json())
		    .then(
		        (result) => {
	            	tbody.setState({
			            users: result
		          	});
		        },
		        (error) => {
		          	this.setState({
		            	error
		          	});
		        }
		    )
		}
	},
	editor(){
		fetch("http://dev.vn/api/home/users",{
          	method: "PATCH",
          	headers: {
              	'Accept': 'application/json',
                'Content-Type': ' application/json',
                'X-API-KEY': 'CODEX@123',
                'Authorization': 'Basic YWRtaW46MTIzNA==',
            },
            body: JSON.stringify({
            	id: this.props.id,
            	fullname:this.refs.fullname.value,
            	email:this.refs.email.value
		    })
        })
	    .then(res => res.json())
	    .then(
	        (result) => {
	          tbody.setState({
	            users: result
	          });
	          this.setState({
				editor:false
	          });
	        },
	        (error) => {
	          this.setState({
	            error
	          });
	        }
	    )
	},
	onEdit(){
		this.setState({
			editor:true
		});
	},
	offEdit(){
		this.setState({
			editor:false
		});
	},
	getInitialState(){		
		return {
			editor:false,
		}
	},
	render(){
		if(this.state.editor){
			return (<tr onMouseLeave={this.offEdit}>
		      	<td scope="row">{this.props.id}</td>
		      	<td><img className="rounded-circle" style={{'width':'74px'}} src={"../assets/img/avatar/"+this.props.img} /></td>
		      	<td>
		      		<div className="row"><div className="col-12"><div className="input-group"><input type="text" ref="fullname" placeholder={this.props.children} className="form-control" /></div></div></div>
		      	</td>
		      	<td>
		      		<div className="row"><div className="col-10"><div className="input-group"><input type="text" ref="email" placeholder={this.props.email} className="form-control" /></div></div><div className="tool-action"><i className="fa fa-send" onClick={this.editor}></i><i className="fa fa-trash" onClick={this.removeTrow}></i></div></div>
		      	</td>
		    </tr>);
		}else{
			return (<tr>
		      	<td scope="row">{this.props.id}</td>
		      	<td><img className="rounded-circle" style={{'width':'74px'}} src={"../assets/img/avatar/"+this.props.img} /></td>
		      	<td>{this.props.children}</td>
		      	<td>{this.props.email} <div className="tool-action"><i className="fa fa-edit" onClick={this.onEdit}></i><i className="fa fa-trash" onClick={this.removeTrow}></i></div></td>
		    </tr>);		
		}
	}
});
var Tbody = React.createClass({
	getInitialState(){		
		tbody = this;
		return {
			users: [],
		}
	},	
	componentDidMount() {
	    fetch("http://dev.vn/api/home/users",{
          	method: "GET",
          	headers: {
              	'Accept': 'application/json',
                'Content-Type': ' application/json',
                'X-API-KEY': 'CODEX@123',
                'Authorization': 'Basic YWRtaW46MTIzNA==',
            },
        })
	    .then(res => res.json())
	    .then(
	        (result) => {
	          tbody.setState({
	            users: result
	          });
	        },
	        (error) => {
	          this.setState({
	            error
	          });
	        }
	    )
  	},
	render(){
		return (
			<tbody>
			{ 
				this.state.users!==null?
					tbody.state.users.map((user)=>{
					return (<Trow id={user.id} img={user.avatar} email={user.email}>{user.fullname}</Trow>);
					})
				:null
			 }
			</tbody>
		);
	}
});
var NewMember = React.createClass({
	newMember(){
		fetch("http://dev.vn/api/home/users",{
          	method: "PUT",
          	headers: {
              	'Accept': 'application/json',
                'Content-Type': ' application/json',
                'X-API-KEY': 'CODEX@123',
                'Authorization': 'Basic YWRtaW46MTIzNA==',
            },
            body: JSON.stringify({
            	"fullname":this.refs.fullname.value,
            	"email":this.refs.email.value
		    })
        })
	    .then(res => res.json())
	    .then(
	        (result) => {
	          tbody.setState({
	            users: result
	          });
	        },
	        (error) => {
	          this.setState({
	            error
	          });
	        }
	    )
	},
	render(){
		return (<div className="modal" id="new-modal" tabindex="-1" role="dialog">
		  	<div className="modal-dialog modal-lg" role="document">
			    <div className="modal-content">
			      <div className="modal-header">
			      	<h5 className="modal-title">New member</h5>
			        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div className="modal-body">
			    	<div className="row">
			    		<div className="col-12">
							<div className="form-group">
							    <label>Fullname</label>
							    <input type="text" className="form-control" ref="fullname" aria-describedby="namelHelp" placeholder="Enter fullname"/>
							    <small id="namelHelp" className="form-text text-muted">We'll using your fullname for contact on the site.</small>
						  	</div>
			    		</div>
			    	</div>
			    	<div className="row">
			    		<div className="col-12">
			    			<div className="form-group">
							    <label>Email address</label>
							    <input type="email" className="form-control" ref="email" aria-describedby="emailHelp" placeholder="Enter email"/>
							    <small id="emailHelp" className="form-text text-muted">We'll never share your email with anyone else.</small>
						  	</div>
			    		</div>
			    	</div>	
			      </div>
			      <div className="modal-footer">
		      		<button type="button" className="btn btn-primary" onClick={this.newMember} data-dismiss="modal" aria-label="Close">
			          	Submit <i className="fa fa-send"></i>
			        </button>
			      </div>
			    </div>
		  	</div>
		</div>);
	}
});
ReactDOM.render(
	<div className="mission-block container">
		<h3 className="hl-title">USER'S LIST<small>You can update the profile.</small></h3>
		<table className="table table-hover user-list">	
			<thead className="thead-dark">
			    <tr>
				    <th width="10%" scope="col">#</th>
				    <th width="20%" scope="col">Avatar </th>
				    <th width="30%" scope="col">Display name </th>
				    <th width="40%" scope="col">Email <a href="#new-modal" data-toggle="modal"><i className="fa fa-plus pull-right fa-2x text-white"></i></a></th>
			    </tr>
		  	</thead>	
			<Tbody />
		</table>
		<NewMember />
	</div>,
	document.getElementById('body')
);