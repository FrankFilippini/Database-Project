package project.core;

/**
 * Interface for the controller of the database's app.
 */

public interface Controller {
    /**
     * method to get the access to the database
     * @param username
     * @param password
     */
    void tryAuthentication(String username, String password);
}
