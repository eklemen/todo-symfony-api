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
			.catch(error => {
		    	dispatch({
		    		type: 'GET_TODOS_REJECTED',
		    		payload: error
		    	});
		  	});	
	}
}

export function toggleComplete(todo, todos){
	return dispatch => {
		// dispatch({type: "TOGGLE_COMPLETE_PENDING"});
		const status = {is_complete: !todo.is_complete}
		axios.put(`http://localhost:8000/api/todos/${todo.id}`, status)
			.then( response => {
				// we are updating the store first and then populating with the data from 
				// the server after to give a more responsive feel.
				const updated = todos.map( item => {
					return item.id === todo.id 
					? {...todo, is_complete: !todo.is_complete}
					: item;
				});
				dispatch({
					type: 'TOGGLE_ITEM',
					payload: updated
				});
				dispatch({type: "TOGGLE_COMPLETE_FULFILLED"})
			})
			.catch(error => {
					dispatch({
						type: 'TOGGLE_COMPLETE_REJECTED',
						payload: error
					});
			})
	}
}
