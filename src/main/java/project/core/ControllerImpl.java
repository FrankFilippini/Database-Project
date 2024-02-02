package project.core;

import project.view.View;
import project.view.SwingView;

/**
 * Implementation of Controller. It allows interactions between Database and view.
 */

public class ControllerImpl implements Controller {
    private final View view = new SwingView(this);

    /**
     * Contructor for the Controller of the app.
     * It starts the view.
     */
    public ControllerImpl(){
        this.view.start();
    }
}
