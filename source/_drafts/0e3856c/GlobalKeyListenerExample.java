
import org.eclipse.swt.SWT;
import org.eclipse.swt.events.ShellListener;
import org.eclipse.swt.graphics.Image;
import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Event;
import org.eclipse.swt.widgets.Listener;
import org.eclipse.swt.widgets.Menu;
import org.eclipse.swt.widgets.MenuItem;
import org.eclipse.swt.widgets.Shell;
import org.eclipse.swt.widgets.Tray;
import org.eclipse.swt.widgets.TrayItem;
import org.jnativehook.GlobalScreen;
import org.jnativehook.NativeHookException;
import org.jnativehook.keyboard.NativeKeyEvent;
import org.jnativehook.keyboard.NativeKeyListener;
import org.mihalis.opal.notify.Notifier;

public class GlobalKeyListenerExample implements NativeKeyListener {
	public void nativeKeyPressed(NativeKeyEvent e) {
		System.out.println("Key Pressed: " + NativeKeyEvent.getKeyText(e.getKeyCode()));

		if (e.getKeyCode() == NativeKeyEvent.VC_ESCAPE) {
			try {
				GlobalScreen.unregisterNativeHook();
			} catch (NativeHookException e1) {
				e1.printStackTrace();
			}
		}
	}

	public void nativeKeyReleased(NativeKeyEvent e) {
		System.out.println("Key Released: " + NativeKeyEvent.getKeyText(e.getKeyCode()));
		Display.getDefault().asyncExec(new Runnable() {
			 public void run() {
					Notifier.notify("New Mail message", "<b>Link </b>Hello, for what \nI understand your problem \nwas basically in the command \n string you sent to jPowershell and\n not in the JAR itself.");
			 }
			});
	}

	public void nativeKeyTyped(NativeKeyEvent e) {
		System.out.println("Key Typed: " + NativeKeyEvent.getKeyText(e.getKeyCode()));
	}

	public static void main(String[] args) {
		
		final Display display = new Display();
		final Shell shell = new Shell(display,SWT.NO_TRIM);
		shell.setText("Notifier Snippet");
		shell.setSize(0, 0);
		shell.setVisible(false);
        Image image = new Image(display, 16, 16);
        final Tray tray = display.getSystemTray();
        if (tray == null) {
            System.out.println("The system tray is not available");
        } else {
            final TrayItem item = new TrayItem(tray, SWT.NONE);
            item.setToolTipText("SWT TrayItem");
            item.addListener(SWT.Show, new Listener() {
                public void handleEvent(Event event) {
                    System.out.println("show");
                }
            });
            item.addListener(SWT.Hide, new Listener() {
                public void handleEvent(Event event) {
                    System.out.println("hide");
                }
            });
            item.addListener(SWT.Selection, new Listener() {
                public void handleEvent(Event event) {
                    System.out.println("selection");
                }
            });
            item.addListener(SWT.DefaultSelection, new Listener() {
                public void handleEvent(Event event) {
                    System.out.println("default selection");
                    // show main
                    Shell s = event.display.getShells()[0];
                    s.setVisible( !s.getVisible());
                    s.setMinimized(!s.getVisible());
                }
            });
            final Menu menu = new Menu(shell, SWT.POP_UP);
            for (int i = 0; i < 8; i++) {
                MenuItem mi = new MenuItem(menu, SWT.PUSH);
                mi.setText("Item" + i);
            }
            item.addListener(SWT.MenuDetect, new Listener() {
                public void handleEvent(Event event) {
                    menu.setVisible(true);
                }
            });
            item.setImage(image);
        }
        shell.addShellListener(new ShellListener() {
            public void shellDeactivated(org.eclipse.swt.events.ShellEvent e) {
            }

            public void shellActivated(org.eclipse.swt.events.ShellEvent e) {
            }

            public void shellClosed(org.eclipse.swt.events.ShellEvent e) {
            }

            public void shellDeiconified(org.eclipse.swt.events.ShellEvent e) {
            }

            public void shellIconified(org.eclipse.swt.events.ShellEvent e) {
  
                ((Shell) e.getSource()).setVisible(false);
            }
        });
		
		try {
			GlobalScreen.registerNativeHook();
		}
		catch (NativeHookException ex) {
			System.err.println("There was a problem registering the native hook.");
			System.err.println(ex.getMessage());

			System.exit(1);
		}

		GlobalScreen.addNativeKeyListener(new GlobalKeyListenerExample());
	
		shell.open();
        shell.setVisible(false);

		while (!shell.isDisposed()) {
			if (!display.readAndDispatch()) {
				display.sleep();
			}
		}
		display.dispose();
	}
}