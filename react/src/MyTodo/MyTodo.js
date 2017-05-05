import React, { Component } from 'react';
import {connect} from 'react-redux';

import {getTodos, toggleComplete, deleteItem, addItem, updateUserInput, submitTodo} from './actions/TodoActions';
import {TodoItem, Footer} from './components/'
export class MyTodo extends Component {

    componentDidMount(){
        this.props.dispatch(getTodos());
    }

    render() {
    	const {todos=[], dispatch, userInput} = this.props;
    	console.log(todos)
        const todoItems = todos.map( todo => {
            return (<TodoItem task={todo.task} 
                              isComplete={todo.is_complete} 
                              key={todo.id} 
                              toggleComplete={() => dispatch(toggleComplete(todo, todos)) }
                              deleteItem={() => dispatch(deleteItem(todo, todos))} />);
        });
        return (
            <div>
                <section className="todoapp">
                    <header className="header">
                        <h1>todos</h1>
                        <form onSubmit={ () => dispatch(submitTodo(userInput)) }>
                            <input className="new-todo" 
                                   placeholder="What needs to be done?"
                                   onChange={ e => dispatch(updateUserInput(e)) }
                                   value={userInput} />
                            <button type="submit"></button>
                        </form>
                    </header>
                    <section className="main">
                        <input className="toggle-all" type="checkbox"/>
                        <label htmlFor="toggle-all">Mark all as complete</label>
                        <ul className="todo-list">
                            {todoItems}
                        </ul>
                    </section>
                    <Footer />
                </section>
            </div>
        );
    }
}

export const mapStateToProps = state => {
	return {
		todos: state.Todos.todoView.data,
        userInput: state.Todos.todoView.userInput
	}
}

export default connect(mapStateToProps)(MyTodo);


