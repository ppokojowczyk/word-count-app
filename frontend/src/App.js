import 'devextreme/dist/css/dx.common.css';
import 'devextreme/dist/css/dx.dark.css';
import './App.css';
import WordCountFormAndGrid from './Component/WordCountFormAndGrid';

const appTitle = "Word Count Application";

function App() {
  return (
    <div className="App">
      <div className="App-wrapper">
        <header className="App-header">
          <span className="dx-icon-contains logo-icon"></span> <span className="App-title">{appTitle}</span>
        </header>
        <WordCountFormAndGrid />
      </div>
    </div>
  );
}

export default App;
