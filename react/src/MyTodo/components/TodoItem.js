import React, { Component } from 'react';

export class TodoItem extends Component {

    render() {
    	const { task, isComplete, toggleComplete } = this.props;
        const complete = isComplete ? "completed" : "";
        console.log(complete);
        return (
            <li className={complete}>
                <div className="view">
                    <input className="toggle" 
                           type="checkbox"
                           checked={isComplete}
                           onChange={toggleComplete} />
                    <label>{task}</label>
                    <button className="destroy"></button>
                </div>
                <input className="edit" 
                       value="Create a TodoMVC template"
                       onChange={()=>{}} />
            </li>
        );
    }
}

export default TodoItem;