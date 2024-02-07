package project.db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.Optional;

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

    /**
     * @return a Connection with the database specified in the class constructor
     * @throws IllegalStateException if the connection could not be establish
     */
    public Optional<Connection> getMySQLConnection() {
        final String dbUri = "jdbc:mysql://localhost:3306/" + this.dbName;
        try {
            return Optional.of(DriverManager.getConnection(dbUri, this.username, this.password));
        } catch (final SQLException e) {
            return Optional.empty();
        }
    }
    
}
