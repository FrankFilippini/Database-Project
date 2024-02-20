package project.core;

import project.view.View;

import java.sql.Connection;
import java.util.Optional;

import project.db.ConnectionProvider;
import project.view.SwingView;

/**
 * Implementation of Controller. It allows interactions between Database and view.
 */

public class ControllerImpl implements Controller {
    private static final String DATABASE_NAME = "bathhouse";
    private final View view = new SwingView(this);
    private ConnectionProvider connectionProvider;
    private Optional<Connection> connection = Optional.empty();

    /**
     * Contructor for the Controller of the app.
     * It starts the view.
     */
    public ControllerImpl(){
        this.view.start();
    }

    @Override
    public void tryAuthentication(String username, String password) {
        this.connectionProvider = new ConnectionProvider(username, password, DATABASE_NAME);
        this.connection = this.connectionProvider.getMySQLConnection();
        if(this.connection.isPresent()) {
           // this.database = new DatabaseImpl();
        }
    }
}
