import axios from 'axios';


export function getTodos(){
	return dispatch => {
		dispatch({type: 'GET_TODOS_PENDING'});
		axios.get('http://localhost:8000/api/todos')
			.then( response => {
				dispatch({
					type: 'GET_TODOS_FULFILLED',
					payload: response.data
				});
			})
			.catch(function (error) {
		    	dispatch({
		    		type: 'GET_TODOS_REJECTED',
		    		payload: error
		    	});
		  	});	
	}
}
