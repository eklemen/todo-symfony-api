const initialState = {
	fetching: false,
	fetched: false,
	error: null,
	data: []
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
		case "TOGGLE_COMPLETE_PENDING":
			return {
				...state,
				data: [...state.data]
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
				data: [],
				error: action.payload
			}
		default:
			return state
	}
}