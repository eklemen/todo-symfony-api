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
		dispatch({type: "TOGGLE_COMPLETE_PENDING"});
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

export function deleteItem(todo, todos){
	return dispatch => {
		axios.delete(`http://localhost:8000/api/todos/${todo.id}`)
			.then( response => {
				const updated = todos.filter( item => {
					return item.id !== todo.id;
				});
				dispatch({
					type: 'DELETE_ITEM',
					payload: updated
				});
				dispatch({type: "DELETE_ITEM_FULFILLED"});
			})
			.catch( error => {
				dispatch({
					type: 'DELETE_ITEM_REJECTED',
					payload: error
				});
			})
	}
}

export function updateUserInput(event){
	return dispatch => {
		let value = event.target.value;
		dispatch({
			type: "UPDATE_USER_INPUT",
			payload: value
		});
	}
}

export function submitTodo(userInput){
	return dispatch => {
		const newTodo = {
			task: userInput,
			is_complete: false
		};
		axios.post(`http://localhost:8000/api/todos/`, newTodo)
			.then(response => {
				let id = response.data.id;
				newTodo.id = id;
				dispatch({
					type: "SUBMIT_TODO_FULFILLED",
					payload: newTodo
				});
			})
			.catch( error => {
				dispatch({type: "SUBMIT_TODO_REJECTED"});
			})
	}
}

export function addItem(newTodo){
	return dispatch => {
		axios.post(`http://localhost:8000/api/todos/`, newTodo)
			.then( response => {

			})
	}
}