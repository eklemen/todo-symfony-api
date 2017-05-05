const initialState = {
	fetching: false,
	fetched: false,
	error: null,
	data: [],
	userInput: ""
}

export function todoView(state = initialState, action) {
	switch (action.type) {

		case "GET_TODOS_PENDING":
			return {
				...state,
				fetching: true,
				fetched: false,
				data: [],
				error: null
			}

		case "GET_TODOS_FULFILLED":
			return {
				...state,
				fetching: false,
				fetched: true,
				data: action.payload,
				error: null
			}
		case "GET_TODOS_REJECTED":
			return {
				...state,
				fetching: false,
				fetched: true,
				data: [],
				error: action.payload
			}
//////////////////// Toggle complete
		case "TOGGLE_ITEM":
			return {
				...state,
				data: action.payload
			}
		case "TOGGLE_COMPLETE_FULFILLED":
			return {
				...state
			}
		case "TOGGLE_COMPLETE_REJECTED":
			return {
				...state,
				fetching: false,
				fetched: true,
				data: state.data,
				error: action.payload
			}

///////////////////// Delete item
		case "DELETE_ITEM":
			return {
				...state,
				data: action.payload
			}
		case "DELETE_ITEM_FULFILLED":
			return {
				...state
			}
		case "DELETE_ITEM_REJECTED":
			return {
				...state,
				fetching: false,
				fetched: true,
				data: state.data,
				error: action.payload
			}
		case "UPDATE_USER_INPUT":
			return {
				...state,
				userInput: action.payload
			}

		case "SUBMIT_TODO_FULFILLED":
			return {
				...state,
				data: [...state.data, action.payload],
				userInput: ""
			}
		case "DELETE_ITEM_REJECTED":
			return {
				...state,
				fetching: false,
				fetched: true,
				data: state.data,
				error: action.payload
			}
		default:
			return state
	}
}