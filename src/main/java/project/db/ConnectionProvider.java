package project.db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class ConnectionProvider {
    private final String username;
    private final String password;
    private final String dbName;

    /**
     * @param username the username used to connect to the database
     * @param password the password used to connect to the database
     * @param dbName the name of the database to connect to
     */
    public ConnectionProvider(String username, String password, String dbName) {
        this.username = username;
        this.password = password;
        this.dbName = dbName;
    }

    
}
