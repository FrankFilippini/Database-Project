package project.view;

import java.awt.Dimension;
import java.awt.Toolkit;

import javax.swing.JFrame;

import project.core.Controller;

/**
 * Implementation of the View using JSwing for the GUI.
 */

public class SwingView implements View {
    private final Controller controller;
    private static final double ASPECT_RATIO = 3.0 / 4.0;
    private static final double SCREEN_FRACTION = 2;
    private final JFrame frame = new JFrame();
    private final Dimension screen = Toolkit.getDefaultToolkit().getScreenSize(); 
    private final Dimension startScreen = new Dimension((int) (screen.getWidth() / SCREEN_FRACTION), 
        (int) (screen.getWidth() / SCREEN_FRACTION * ASPECT_RATIO));

    /**
     * Constructor for SwingView.
     * @param controller is the controller of the app
     */
    public SwingView(Controller controller) {
        this.controller = controller;
        this.frame.setSize(this.startScreen);
        this.frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.frame.setPreferredSize(this.frame.getSize());
        this.frame.setResizable(true);
    }

    @Override
    public void start() {
        this.frame.setLocation((int)startScreen.getWidth(), (int)startScreen.getHeight());
        this.frame.setVisible(true);
    }

    /**
     * {@inheritDoc}
     */
    @Override
    public void startConnection() {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'startConnection'");
    }

    @Override
    public void tryAuthentication() {
        this.controller.tryAuthentication("root", "");
    }
}
